<?php

namespace App\Interfaces\Treatments;

interface TreatmentRepositoryInterface
{
    public function index();
    public function add($id);
    public function add_a_review($id);
    public function show($id);
    public function store($request);
    public function storeReview($request);
    public function destroy($id);
}
