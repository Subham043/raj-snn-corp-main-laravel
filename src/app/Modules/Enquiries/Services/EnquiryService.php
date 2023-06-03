<?php

namespace App\Modules\Enquiries\Services;

use App\Modules\Enquiries\Models\Enquiry;
use App\Modules\Enquiries\Requests\EnquiryRequest;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

class EnquiryService
{
    private $enquiryModel;

    public function __construct(Enquiry $enquiryModel)
    {
        $this->enquiryModel = $enquiryModel;
    }

    public function all(): Collection
    {
        return $this->enquiryModel->orderBy('id', 'DESC')->get();
    }

    public function paginate(Request $request, Int $limit = 10): LengthAwarePaginator
    {
        if ($request->has('search')) {
            $search = $request->input('search');
            return $this->enquiryModel->where('is_verified', true)
            ->where(function($q) use($search){
                $q->where('name', 'like', '%' . $search . '%')
                ->orWhere('email', 'like', '%' . $search . '%')
                ->orWhere('phone', 'like', '%' . $search . '%')
                ->orWhere('ip_address', 'like', '%' . $search . '%')
                ->orWhere('page_url', 'like', '%' . $search . '%');
            })
            ->orderBy('id', 'DESC')->paginate($limit);
        }
        return $this->enquiryModel->where('is_verified', true)->orderBy('id', 'DESC')->paginate($limit);
    }

    public function getById(Int $id): Enquiry
    {
        return $this->enquiryModel->findOrFail($id);
    }

    public function create(EnquiryRequest $request): Enquiry
    {
        return $this->enquiryModel->create([
            ...$request->all(),
            'otp' => rand(1000,9999),
            'ip_address' => $request->ip(),
            'is_verified' => false,
        ]);
    }

    public function update(array $data, Enquiry $enquiry): Enquiry
    {
        $enquiry->update($data);
        return $enquiry;
    }

    public function delete(Enquiry $data): void
    {
        $data->delete();
    }
}
