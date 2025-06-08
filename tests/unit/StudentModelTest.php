<?php

namespace Tests\Unit;

use CodeIgniter\Test\CIUnitTestCase;
use App\Models\StudentModel;

class StudentModelTest extends CIUnitTestCase
{
    protected $studentModel;

    protected function setUp(): void
    {
        parent::setUp();
        $this->studentModel = new StudentModel();
    }

    public function testInsertStudent()
    {
        $data = [
            'name'          => 'Test User',
            'email'         => 'testuser@example.com',
            'university'    => 'Tech University',
            'phone'         => '0712345678',
            'admission_no'  => 'TU123456',
            'course'        => 'Computer Science',
            'skills'        => 'PHP,JavaScript',
            'password'      => password_hash('password123', PASSWORD_BCRYPT),
            'is_verified'   => 0,
        ];

        $this->studentModel->insert($data);
        $this->assertGreaterThan(0, $this->studentModel->getInsertID());
    }

    public function testFindStudentByEmail()
    {
        $email = 'testuser@example.com';
        $student = $this->studentModel->where('email', $email)->first();

        $this->assertIsArray($student);
        $this->assertEquals($email, $student['email']);
    }

    public function testUpdateStudent()
    {
        $student = $this->studentModel->where('email', 'testuser@example.com')->first();

        $updated = $this->studentModel->update($student['id'], ['name' => 'Updated User']);
        $this->assertTrue($updated);

        $updatedStudent = $this->studentModel->find($student['id']);
        $this->assertEquals('Updated User', $updatedStudent['name']);
    }
}
