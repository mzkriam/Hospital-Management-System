<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTreatmentRequest;
use App\Interfaces\Treatments\TreatmentRepositoryInterface;

class TreatmentController extends Controller
{
    private $treatment;
    public function __construct(TreatmentRepositoryInterface $treatment)
    {
        $this->treatment = $treatment;
    }

    public function index()
    {
        return $this->treatment->index();
    }
    public function add($id)
    {
        return $this->treatment->add($id);
    }
    public function add_a_review($id)
    {
        return $this->treatment->add_a_review($id);
    }

    public function store(StoreTreatmentRequest $request)
    {
        return $this->treatment->store($request);
    }
    public function storeReview(StoreTreatmentRequest $request)
    {
        return $this->treatment->storeReview($request);
    }
    public function show($id)
    {
        return $this->treatment->show($id);
    }
    public function destroy($id)
    {
        return $this->treatment->destroy($id);
    }
}
