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
            return $this->enquiryModel
            ->where('name', 'like', '%' . $search . '%')
            ->orWhere('email', 'like', '%' . $search . '%')
            ->orWhere('phone', 'like', '%' . $search . '%')
            ->orWhere('page_url', 'like', '%' . $search . '%')
            ->orderBy('id', 'DESC')->paginate($limit);
        }
        return $this->enquiryModel->orderBy('id', 'DESC')->paginate($limit);
    }

    public function getById(Int $id): Enquiry
    {
        return $this->enquiryModel->findOrFail($id);
    }

    public function create(EnquiryRequest $request): void
    {
        $this->enquiryModel->create([
            ...$request->all(),
        ]);
    }

    public function delete(Enquiry $data): void
    {
        $data->delete();
    }
}
