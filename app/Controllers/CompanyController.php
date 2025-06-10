<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\OpportunityModel;
use App\Models\ApplicationModel;
use App\Models\TestModel;

class CompanyController extends BaseController
{
    public function index()
{
    $companyId = session()->get('user_id');

    $applicationModel = new \App\Models\ApplicationModel();
    $opportunityModel = new \App\Models\OpportunityModel();
    $testModel = new \App\Models\TestModel();
    $studentModel = new \App\Models\StudentModel();

    // Total Applicants
    $totalApplicants = $applicationModel
        ->join('opportunities', 'opportunities.id = applications.opportunity_id')
        ->where('opportunities.company_id', $companyId)
        ->countAllResults();

    // Applications this week
    $weeklyApplicants = $applicationModel
        ->join('opportunities', 'opportunities.id = applications.opportunity_id')
        ->where('opportunities.company_id', $companyId)
        ->where('applications.created_at >=', date('Y-m-d', strtotime('-7 days')))
        ->countAllResults();

    // Active postings
    $activePostings = $opportunityModel
        ->where('company_id', $companyId)
        ->countAllResults();

    $filledPositions = 2; // Placeholder (add logic when/if you support it)

    // Tests
    $testsCompleted = $testModel
        ->where('company_id', $companyId)
        ->where('status', 'completed')
        ->countAllResults();

    $testsPending = $testModel
        ->where('company_id', $companyId)
        ->where('status', 'pending')
        ->countAllResults();

    // Interviews
    $interviewsScheduled = $applicationModel
        ->join('opportunities', 'opportunities.id = applications.opportunity_id')
        ->where('opportunities.company_id', $companyId)
        ->where('applications.status', 'interview')
        ->countAllResults();

    $interviewsThisWeek = 3; // Static or future logic

    // ✅ Safe Recent Applications (no GPA or test joins)
    $recentApplications = $applicationModel
        ->select('applications.*, students.name as student_name, students.university')
        ->join('opportunities', 'opportunities.id = applications.opportunity_id')
        ->join('students', 'students.id = applications.student_id')
        ->where('opportunities.company_id', $companyId)
        ->orderBy('applications.created_at', 'DESC')
        ->limit(4)
        ->findAll();

    // Posting Performance
    $postingsPerformance = $opportunityModel
        ->select('opportunities.*, COUNT(applications.id) as application_count')
        ->join('applications', 'applications.opportunity_id = opportunities.id', 'left')
        ->where('opportunities.company_id', $companyId)
        ->groupBy('opportunities.id')
        ->orderBy('opportunities.created_at', 'DESC')
        ->findAll();

    return view('pages/company/dashboard', [
        'totalApplicants'      => $totalApplicants,
        'weeklyApplicants'     => $weeklyApplicants,
        'activePostings'       => $activePostings,
        'filledPositions'      => $filledPositions,
        'testsCompleted'       => $testsCompleted,
        'testsPending'         => $testsPending,
        'interviewsScheduled'  => $interviewsScheduled,
        'interviewsThisWeek'   => $interviewsThisWeek,
        'recentApplications'   => $recentApplications,
        'postingsPerformance'  => $postingsPerformance
    ]);
}


    // Form to show opportunity creation
    public function postOpportunityForm()
    {
        return view('pages/company/post_opportunity');
    }

    // Handle opportunity form submission
    public function submitOpportunity()
    {
        $opportunityModel = new OpportunityModel();

        $data = $this->request->getPost();

        $data['uuid'] = uniqid(); // UUID generation
        $data['company_id'] = session()->get('user_id');

        // Validate inputs before saving
        $rules = [
            'title'       => 'required|min_length[3]',
            'type'        => 'required',
            'description' => 'required',
            'location'    => 'required',
            'deadline'    => 'required|valid_date'
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('validation', $this->validator);
        }

        // Insert into DB
        $opportunityModel->insert($data);

        return redirect()->to('company')->with('message', 'Opportunity posted successfully.');
    }

    public function editOpportunity($uuid)
{
    $model = new \App\Models\OpportunityModel();
    $opportunity = $model->findByUUID($uuid);

    if (!$opportunity || $opportunity['company_id'] != session()->get('user_id')) {
        return redirect()->to('company')->with('error', 'Opportunity not found or access denied.');
    }

    return view('pages/company/edit_opportunity', ['opportunity' => $opportunity]);
}

public function updateOpportunity($uuid)
{
    $model = new \App\Models\OpportunityModel();
    $opportunity = $model->findByUUID($uuid);

    if (!$opportunity || $opportunity['company_id'] != session()->get('user_id')) {
        return redirect()->to('company')->with('error', 'Invalid opportunity.');
    }

    $data = $this->request->getPost();
    $data['updated_at'] = date('Y-m-d H:i:s');

    $model->update($opportunity['id'], $data);

    return redirect()->to('company')->with('message', 'Opportunity updated successfully.');
}


    // View student applications for opportunities posted by this company
 public function viewApplications()
{
    $applicationModel = new \App\Models\ApplicationModel();
    $companyId = session()->get('user_id');

    $applications = $applicationModel
        ->select('applications.*, students.name as student_name, students.university, opportunities.title as opportunity_title')
        ->join('opportunities', 'opportunities.id = applications.opportunity_id')
        ->join('students', 'students.id = applications.student_id')
        ->where('opportunities.company_id', $companyId)
        ->orderBy('applications.created_at', 'DESC')
        ->findAll();

    return view('pages/company/applications', [
        'applications' => $applications
    ]);
}


    public function listOpportunities()
{
    $model = new OpportunityModel();
    $companyId = session()->get('user_id');

    $opportunities = $model
        ->where('company_id', $companyId)
        ->orderBy('created_at', 'DESC')
        ->findAll();

    return view('pages/company/manage_opportunities', ['opportunities' => $opportunities]);
}


    public function viewTests()
    {
        $testModel = new TestModel();

        $tests = $testModel->where('company_id', session()->get('user_id'))->findAll();

        return view('pages/company/tests', ['tests' => $tests]);
    }

    public function messages()
    {
        return view('pages/company/messages', ['messages' => []]);
    }


}
