<?php

namespace Tests\Unit;

use CodeIgniter\Test\CIUnitTestCase;
use App\Models\StudentModel;

class StudentModelTest extends CIUnitTestCase
{
    protected $refresh = true; // Rebuild DB between tests (requires correct setup)

    public function testInsertStudent()
    {
        $model = new StudentModel();

        $data = [
            'name'         => 'John Doe',
            'email'        => 'johndoee@example.com',
            'university'   => 'Test University',
            'admission_no' => 'ADM1234',
            'password'     => password_hash('secret', PASSWORD_DEFAULT),
        ];

        $this->assertTrue($model->insert($data) !== false);
    }

    public function testFindStudentByEmail()
    {
        $model = new StudentModel();

        $student = $model->where('email', 'johndoee@example.com')->first();

        $this->assertIsArray($student);
        $this->assertEquals('John Doe', $student['name']);
    }
}
