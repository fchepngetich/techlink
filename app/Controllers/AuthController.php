<?php

namespace App\Controllers;

use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\I18n\Time;

use App\Models\StudentModel;
use CodeIgniter\RESTful\ResourceController;
use App\Models\StudentDocumentModel;

helper(['text', 'slughelper', 'jwthelper']);

class AuthController extends ResourceController
{
    protected $modelName = StudentModel::class;
    protected $format = 'json';

public function showRegisterForm()
{
    return view('pages/auth/register');
}
public function register()
{
    helper(['form', 'url']);

    $rules = [
        'name'         => 'required|min_length[3]',
        'email'        => 'required|valid_email|is_unique[students.email]',
        'password'     => 'required|min_length[6]',
        'confirm'      => 'matches[password]',
        'university'   => 'required',
        'admission_no' => 'required|is_unique[students.admission_no]',
    ];

    if (!$this->validate($rules)) {
        return redirect()->back()->withInput()->with('validation', $this->validator);
    }

    $verificationCode = rand(100000, 999999);

    $studentModel = new StudentModel();

    $studentModel->save([
        'name'              => $this->request->getPost('name'),
        'email'             => $this->request->getPost('email'),
        'password'          => password_hash($this->request->getPost('password'), PASSWORD_BCRYPT),
        'university'        => $this->request->getPost('university'),
        'admission_no'      => $this->request->getPost('admission_no'),
        'verification_code' => $verificationCode,
        'is_verified'       => 0,
    ]);

    $studentId = $studentModel->getInsertID();

    // Store user ID in session for verification step
    session()->set('unverified_student_id', $studentId);

    // Send verification code via email
    $this->sendVerificationEmail($this->request->getPost('email'), $verificationCode);

    return redirect()->to('/auth/verify')->with('message', 'We’ve sent a verification code to your email.');
}

private function sendVerificationEmail($email, $code)
{
    $emailService = \Config\Services::email();
    $emailService->setTo($email);
    $emailService->setFrom('noreply@techlink.com', 'Techlink');
    $emailService->setSubject('Your Techlink Verification Code');
    $emailService->setMessage("Hi there, your verification code is: <strong>$code</strong>");

    return $emailService->send();
}

public function showVerificationForm()
{
    return view('pages/auth/verify');
}

public function verifyCode()
{
    $studentId = session()->get('unverified_student_id');
    $enteredCode = $this->request->getPost('code');

    $studentModel = new StudentModel();
    $student = $studentModel->find($studentId);

    if ($student && $student['verification_code'] === $enteredCode) {
        // Mark as verified
        $studentModel->update($studentId, [
            'is_verified' => 1,
            'verification_code' => null,
        ]);

        // Set session and remove temporary data
        session()->remove('unverified_student_id');
        session()->set([
            'student_id' => $studentId,
            'name'       => $student['name'],
            'isLoggedIn' => true,
        ]);

        return redirect()->to('/')->with('message', 'Account verified. Welcome!');
    }

    return redirect()->back()->with('error', 'Invalid code, please try again.');
}

public function login()
    {
        return view('pages/auth/login'); 
    }

    public function loginSubmit()
{
    $session = session();
    $email = $this->request->getPost('email');
    $password = $this->request->getPost('password');

    log_message('info', "Login attempt for email: {$email}");

    // Try student first
    $studentModel = new StudentModel();
    $student = $studentModel->where('email', $email)->first();

    if ($student) {
        log_message('debug', "Student record found for: {$email}");

        if (password_verify($password, $student['password'])) {
            log_message('info', "Student login successful: {$email}");

            $session->set([
                //'user_id'     => $student['id'],
                'student_id'  => $student['id'], 
                'name'        => $student['name'],
                'email'       => $student['email'],
                'role'        => $student['role'] ?? 'student',
                'isLoggedIn'  => true
            ]);

            return redirect()->to('/');
        }

        log_message('warning', "Student password incorrect: {$email}");
    }

    // Try company next
    $companyModel = new \App\Models\CompanyModel();
    $company = $companyModel->where('email', $email)->first();

    if ($company) {
        log_message('debug', "Company record found for: {$email}");

        if (password_verify($password, $company['password'])) {
            log_message('info', "Company login successful: {$email}");

            $session->set([
                'user_id'     => $company['id'],
                'company_id'  => $company['id'], 
                'name'        => $company['name'],
                'email'       => $company['email'],
                'role'        => $company['role'] ?? 'company',
                'isLoggedIn'  => true
            ]);

            return redirect()->to('/company');
        }

        log_message('warning', "Company password incorrect: {$email}");
    }

    // Both login attempts failed
    log_message('error', "Login failed for email: {$email}");

    return redirect()->back()
        ->withInput()
        ->with('error', 'Invalid email or password');
}

//     public function loginSubmit()
// {
//     $session = session();
//     $email = $this->request->getPost('email');
//     $password = $this->request->getPost('password');

//     log_message('info', "Login attempt for email: {$email}");

//     // Try student first
//     $studentModel = new StudentModel();
//     $student = $studentModel->where('email', $email)->first();

//     if ($student) {
//         log_message('debug', "Student record found for: {$email}");

//         if (password_verify($password, $student['password'])) {
//             if (!$student['is_verified']) {
//                 log_message('notice', "Unverified student attempted login: {$email}");

//                 return redirect()->to('auth/verify-email')->with('error', 'Please verify your email before logging in.');
//             }

//             log_message('info', "Student login successful: {$email}");

//             $session->set([
//                 'student_id'  => $student['id'], 
//                 'name'        => $student['name'],
//                 'email'       => $student['email'],
//                 'role'        => $student['role'] ?? 'student',
//                 'isLoggedIn'  => true
//             ]);

//             return redirect()->to('/');
//         }

//         log_message('warning', "Student password incorrect: {$email}");
//     }

//     // Try company next
//     $companyModel = new \App\Models\CompanyModel();
//     $company = $companyModel->where('email', $email)->first();

//     if ($company) {
//         log_message('debug', "Company record found for: {$email}");

//         if (password_verify($password, $company['password'])) {
//             log_message('info', "Company login successful: {$email}");

//             $session->set([
//                 'user_id'     => $company['id'],
//                 'company_id'  => $company['id'], 
//                 'name'        => $company['name'],
//                 'email'       => $company['email'],
//                 'role'        => $company['role'] ?? 'company',
//                 'isLoggedIn'  => true
//             ]);

//             return redirect()->to('/company');
//         }

//         log_message('warning', "Company password incorrect: {$email}");
//     }

//     // Both login attempts failed
//     log_message('error', "Login failed for email: {$email}");

//     return redirect()->back()
//         ->withInput()
//         ->with('error', 'Invalid email or password');
// }

public function verifyEmail()
{
    return view('pages/auth/verify_email');
}

public function resendVerification()
{
    $session = session();
    $email = $session->get('email');

    if (!$email) {
        return redirect()->to('auth/login')->with('error', 'Session expired. Please log in again.');
    }

    $studentModel = new StudentModel();
    $student = $studentModel->where('email', $email)->first();

    if (!$student) {
        return redirect()->to('auth/login')->with('error', 'Account not found.');
    }

    if ($student['is_verified']) {
        return redirect()->to('/')->with('message', 'Your account is already verified.');
    }

    $token = bin2hex(random_bytes(32));
    $studentModel->update($student['id'], ['verification_token' => $token]);

    $this->sendVerificationEmail($email, $token);

    return redirect()->back()->with('message', 'Verification email resent successfully.');
}


public function logout()
    {
        session()->destroy();
        return redirect()->to('/auth/login');
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

