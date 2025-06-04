<?php

namespace App\Controllers;

use CodeIgniter\HTTP\ResponseInterface;

use App\Models\StudentModel;
use CodeIgniter\RESTful\ResourceController;
use App\Models\StudentDocumentModel;



helper(['text', 'slughelper', 'jwthelper']);

class StudentController extends ResourceController
{
    protected $modelName = StudentModel::class;
    protected $format = 'json';

    public function register()
    {
        $rules = [
            'name' => 'required|min_length[3]',
            'email' => 'required|valid_email|is_unique[students.email]',
            'password' => 'required|min_length[6]',
            'university' => 'required',
            'admission_no' => 'required|is_unique[students.admission_no]',
        ];

        if (!$this->validate($rules)) {
            return $this->failValidationErrors($this->validator->getErrors());
        }

        $data = [
            'name' => $this->request->getVar('name'),
            'email' => $this->request->getVar('email'),
            'password' => password_hash($this->request->getVar('password'), PASSWORD_BCRYPT),
            'university' => $this->request->getVar('university'),
            'admission_no' => $this->request->getVar('admission_no'),
            'skills' => $this->request->getVar('skills'),
            'cv_path' => $this->request->getVar('cv_path'),
            'transcript_path' => $this->request->getVar('transcript_path'),
        ];

        $this->model->save($data);
        return $this->respondCreated(['message' => 'Student registered successfully']);
    }

    public function login()
    {
        $email = $this->request->getVar('email');
        $password = $this->request->getVar('password');

        $student = $this->model->where('email', $email)->first();

        if (!$student || !password_verify($password, $student['password'])) {
            return $this->failUnauthorized('Invalid email or password');
        }

        $token = generateJWT(['id' => $student['id'], 'email' => $student['email']], env('JWT_SECRET'));
        return $this->respond(['token' => $token, 'student' => $student]);
    }


public function getProfile()
{
    $studentId = $this->getStudentIdFromToken();
    $student = $this->model->find($studentId);

    if (!$student) {
        return $this->failNotFound("Student not found.");
    }

    unset($student['password']); 
    return $this->respond($student);
}

public function updateProfile()
{
    $studentId = $this->getStudentIdFromToken();
    $data = $this->request->getRawInput();

    $update = [
        'bio' => $data['bio'] ?? null,
        'skills' => $data['skills'] ?? null,
        'portfolio_link' => $data['portfolio_link'] ?? null,
        'university' => $data['university'] ?? null,
    ];

    $this->model->update($studentId, $update);
    return $this->respond(['message' => 'Profile updated successfully']);
}

public function uploadDocument()
{
    $studentId = $this->getStudentIdFromToken();
    $file = $this->request->getFile('file');
    $type = $this->request->getPost('type');

    if (!$file || !$file->isValid()) {
        return $this->fail('Invalid file upload');
    }

    $path = $file->store('uploads/documents');
    $docModel = new StudentDocumentModel();
    $docModel->save([
        'student_id' => $studentId,
        'type' => $type,
        'path' => $path,
    ]);

    return $this->respondCreated(['message' => 'Document uploaded successfully']);
}

public function getDocuments()
{
    $studentId = $this->getStudentIdFromToken();
    $docModel = new StudentDocumentModel();
    $docs = $docModel->where('student_id', $studentId)->findAll();

    return $this->respond($docs);
}

private function getStudentIdFromToken()
{
   $authHeader = $this->request->getHeaderLine('Authorization');
    $token = explode(' ', $authHeader)[1] ?? null;

    if (!$token) {
        return null;
    }

    $decoded = validateJWT($token, env('JWT_SECRET'));
    return $decoded->data->id ?? null;
}

}

