<?php

namespace App\Controllers;
use App\Models\StudentModel;
use App\Models\StudentDocumentModel;
use App\Models\ApplicationModel;
use App\Models\OpportunityModel;
use App\Models\CompanyModel;

class Home extends BaseController
{
    public function index()
    {
        $studentId = session()->get('student_id');

        $studentModel = new StudentModel();
        $documentModel = new StudentDocumentModel();
        $applicationModel = new ApplicationModel();
        $testsModel = new \App\Models\TestModel();
        $viewModel = new \App\Models\CompanyViewModel();

        // Get student & documents
        $student = $studentModel->find($studentId);
        $documents = $documentModel->where('student_id', $studentId)->findAll();


        // Profile Completion Logic
        $completion = 0;
        $fields = ['name', 'email', 'phone', 'university', 'admission_no', 'course', 'skills', 'github', 'portfolio'];

        foreach ($fields as $field) {
            if (!empty($student[$field])) {
                $completion += 10;
            }
        }
        if (!empty($documents)) {
            $completion += 10;
        }
        if ($completion > 100)
            $completion = 100;

        // Dashboard Stats
        $applicationsCount = $applicationModel
            ->where('student_id', $studentId)
            ->countAllResults();

        $companiesViewed = $viewModel
            ->where('student_id', $studentId)
            ->countAllResults();
        $testsCompleted = $testsModel
            ->where('student_id', $studentId)
            ->where('status', 'completed')
            ->countAllResults();

        $testsPending = $testsModel
            ->where('student_id', $studentId)
            ->where('status', 'pending')
            ->countAllResults();

        $data['stats'] = [
            'applications_sent' => $applicationsCount,
            'applications_growth' => 3,
            'companies_viewed' => $companiesViewed,
            'companies_growth' => 5,
            'tests_completed' => $testsCompleted,
            'tests_pending' => $testsPending,
            'profile_percent' => $completion . '%',
            'profile_growth' => 15
        ];

        // Pass to View

        $data['student'] = $student;
        $data['documents'] = $documents;
        $data['applications'] = $applicationModel
            ->select('applications.*, opportunities.title as opportunity_title, companies.name as company_name')
            ->join('opportunities', 'opportunities.id = applications.opportunity_id')
            ->join('companies', 'companies.id = opportunities.company_id')
            ->where('applications.student_id', $studentId)
            ->findAll();


        return view('pages/student/dashboard', $data);
    }



    public function viewProfile()
    {
        $studentId = session()->get('student_id');

        if (!$studentId) {
            return redirect()->to('/auth/login')->with('error', 'Please login first.');
        }

        $studentModel = new StudentModel();
        $docModel = new StudentDocumentModel();

        $student = $studentModel->find($studentId);
        $documents = $docModel->where('student_id', $studentId)->findAll();

        $filled = 0;
        $fields = [
            'name',
            'email',
            'phone',
            'university',
            'admission_no',
            'course',
            'skills',
            'github',
            'portfolio'
        ];

        foreach ($fields as $field) {
            if (!empty($student[$field])) {
                $filled += 10;
            }
        }

        if (!empty($documents)) {
            $filled += 10;
        }

        $data = [
            'student' => $student,
            'documents' => $documents,
            'completion' => $filled
        ];

        return view('pages/student/profile', $data);
    }

    public function editProfile()
    {
        $studentId = session()->get('student_id');
        $model = new StudentModel();
        $student = $model->find($studentId);

        return view('pages/student/edit-profile', ['student' => $student]);
    }

    public function updateProfile()
    {
        $studentId = session()->get('student_id');
        $model = new StudentModel();

        $rules = [
            'name' => 'required|min_length[2]',
            'email' => 'required|valid_email',
            'phone' => 'permit_empty',
            'admission_no' => 'permit_empty',
            'course' => 'permit_empty',
            'university' => 'required|min_length[2]',
            'skills' => 'permit_empty',
            'github' => 'permit_empty|valid_url',
            'portfolio' => 'permit_empty|valid_url',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $data = [
            'name' => $this->request->getPost('name'),
            'email' => $this->request->getPost('email'),
            'phone' => $this->request->getPost('phone'),
            'admission_no' => $this->request->getPost('admission_no'),
            'course' => $this->request->getPost('course'),
            'university' => $this->request->getPost('university'),
            'skills' => $this->request->getPost('skills'),
            'github' => $this->request->getPost('github'),
            'portfolio' => $this->request->getPost('portfolio'),
        ];

        $model->update($studentId, $data);

        return redirect()->to('student/profile')->with('message', 'Profile updated successfully.');
    }

    public function listOpportunities()
    {
        $studentId = session()->get('student_id');

        $opModel = new OpportunityModel();
        $applicationModel = new ApplicationModel();

        // Get all opportunities
        $opportunities = $opModel->select('opportunities.*, companies.name AS company_name')
            ->join('companies', 'companies.id = opportunities.company_id')
            ->orderBy('deadline', 'ASC')
            ->findAll();

        // Get IDs of already applied opportunities
        $applied = $applicationModel
            ->where('student_id', $studentId)
            ->findAll();

        $appliedIds = array_column($applied, 'opportunity_id');

        return view('pages/student/opportunities', [
            'opportunities' => $opportunities,
            'appliedIds' => $appliedIds
        ]);
    }


    public function apply($opportunityId)
    {
        $studentId = session()->get('student_id');
        if (!$studentId) {
            return redirect()->to('/auth/login');
        }

        $appModel = new ApplicationModel();
        // Prevent duplicate applications
        $exists = $appModel->where(['student_id' => $studentId, 'opportunity_id' => $opportunityId])->first();

        if ($exists) {
            return redirect()->back()->with('error', 'You already applied.');
        }

        $appModel->insert([
            'student_id' => $studentId,
            'opportunity_id' => $opportunityId
        ]);

        return redirect()->back()->with('message', 'Application submitted.');
    }

    public function viewOpportunity($uuid)
    {
        $model = new OpportunityModel();
        $applicationModel = new \App\Models\ApplicationModel();

        $opportunity = $model
            ->select('opportunities.*, companies.name AS company_name, companies.id AS company_id')
            ->join('companies', 'companies.id = opportunities.company_id')
            ->where('opportunities.uuid', $uuid)
            ->first();

        if (!$opportunity) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound("Opportunity not found.");
        }

        $studentId = session()->get('student_id');

        //Check if already applied
        $alreadyApplied = $applicationModel
            ->where('student_id', $studentId)
            ->where('opportunity_id', $opportunity['id'])
            ->first();

        //Log company view
        $viewModel = new \App\Models\CompanyViewModel();
        $alreadyViewed = $viewModel
            ->where('student_id', $studentId)
            ->where('company_id', $opportunity['company_id'])
            ->where('DATE(viewed_at)', date('Y-m-d'))
            ->first();

        if (!$alreadyViewed) {
            $viewModel->insert([
                'student_id' => $studentId,
                'company_id' => $opportunity['company_id'],
                'viewed_at' => date('Y-m-d H:i:s')
            ]);
        }

        return view('pages/student/opportunity_details', [
            'opportunity' => $opportunity,
            'alreadyApplied' => $alreadyApplied !== null
        ]);
    }



    public function applyToOpportunity($uuid)
    {
        $studentId = session()->get('student_id');
        if (!$studentId)
            return redirect()->to('/auth/login');

        $opModel = new OpportunityModel();
        $appModel = new ApplicationModel();

        $opportunity = $opModel->where('uuid', $uuid)->first();
        if (!$opportunity)
            return redirect()->back()->with('error', 'Invalid opportunity');

        // Check if already applied
        $existing = $appModel->where([
            'student_id' => $studentId,
            'opportunity_id' => $opportunity['id']
        ])->first();

        if ($existing) {
            return redirect()->back()->with('error', 'Already applied.');
        }

        $appModel->save([
            'student_id' => $studentId,
            'opportunity_id' => $opportunity['id']
        ]);

        return redirect()->to('/student/opportunities')->with('message', 'Application submitted.');
    }

    public function myApplications()
    {
        $studentId = session()->get('student_id');

        if (!$studentId) {
            return redirect()->to('auth/login')->with('error', 'Please log in to view your applications.');
        }

        $appModel = new ApplicationModel();

        $applications = $appModel
            ->select('applications.*, opportunities.title AS opportunity_title, opportunities.uuid AS opportunity_uuid, companies.name AS company_name')
            ->join('opportunities', 'opportunities.id = applications.opportunity_id')
            ->join('companies', 'companies.id = opportunities.company_id')
            ->where('applications.student_id', $studentId)
            ->orderBy('applications.created_at', 'DESC')
            ->findAll();

        return view('pages/student/my_applications', ['applications' => $applications]);
    }

    public function listTests()
    {
        $studentId = session()->get('student_id');

        // (In production: Pull from DB, joined with test + company + opportunity info)

        $tests = [
            [
                'title' => 'Design Thinking Assessment',
                'company' => 'Innova Solutions',
                'role' => 'UI/UX Design Mentorship',
                'status' => 'completed',
                'scheduled' => '2025-07-10',
                'score' => 92,
            ],
            [
                'title' => 'HTML/CSS/JS Quiz',
                'company' => 'TechHive Ltd.',
                'role' => 'Frontend Developer Intern',
                'status' => 'pending',
                'scheduled' => '2025-08-15',
            ],
            [
                'title' => 'PHP & SQL Assessment',
                'company' => 'TechHive Ltd.',
                'role' => 'Backend Developer Trainee',
                'status' => 'upcoming',
                'scheduled' => '2025-09-01',
            ],
            [
                'title' => 'Linux & Cloud Basics',
                'company' => 'Innova Solutions',
                'role' => 'Junior DevOps Engineer',
                'status' => 'unassigned',
                'scheduled' => null,
            ],
        ];

        return view('pages/student/test', ['tests' => $tests]);
    }

    public function notifications()
    {
        $data['notifications'] = [
            [
                'title' => 'Test Result Available',
                'message' => 'Your Aptitude Test with <strong>TechHive Ltd.</strong> (Frontend Developer Intern) has been graded.',
                'date' => '2025-06-11 10:30 AM'
            ],
            [
                'title' => 'Interview Invitation',
                'message' => 'You are invited for an interview at <strong>Innova Solutions</strong> for the UI/UX Design Mentorship.',
                'date' => '2025-06-10 02:15 PM'
            ],
            [
                'title' => 'New Opportunity Posted',
                'message' => '<strong>TechHive Ltd.</strong> just posted a new Backend Developer Trainee role.',
                'date' => '2025-06-09 11:00 AM'
            ],
            [
                'title' => 'Profile Update Approved',
                'message' => 'Your updated student profile was approved by <strong>Admin</strong>.',
                'date' => '2025-06-08 09:20 AM'
            ]
        ];

        return view('pages/student/notifications', $data);
    }




}
