<?php

namespace App\Livewire\Pages\Voucher;

use App\Models\Course;
use App\Models\User;
use App\Services\VoucherService;
use Carbon\Carbon;
use Livewire\Component;

class VoucherUpdateLivewire extends Component
{
    public $voucher;
    public $name;
    public $description;
    public $code;
    public $qty;
    public $validStart;
    public $validEnd;
    public $discOffPrice;
    public $discOffPercent;

    public $courses;
    public $members;

    public $minimumTransaction = 0;
    public $minimumOrder = 1;

    public $selectedCourse;
    public $ruleCourses = [];

    public $selectedMember;
    public $ruleMembers = [];

    protected $rules = [
        'name' => 'required',
        'description' => 'required',
        'code' => 'required',
        'qty' => 'required',
        'validStart' => 'required',
        'validEnd' => 'required',
        'discOffPrice' => 'required',
        'discOffPercent' => 'required',
    ];

    public function mount()
    {
        $this->courses = Course::get();
        $this->members = User::get();

        $this->name = $this->voucher->name;
        $this->description = $this->voucher->description;
        $this->code = $this->voucher->code;
        $this->qty = $this->voucher->qty;
        $this->validStart = Carbon::parse($this->voucher->valid_start)->format('Y-m-d');
        $this->validEnd = Carbon::parse($this->voucher->valid_end)->format('Y-m-d');
        $this->discOffPrice = $this->voucher->disc_off_price;
        $this->discOffPercent = $this->voucher->disc_off_percent;

        $rules = json_decode($this->voucher->rules);
        $this->minimumOrder = $rules->minimumOrder ?? 1;
        $this->minimumTransaction = $rules->minimumTransaction ?? 0;
        $this->ruleCourses = $rules->allowedCourses ?? [];
        $this->ruleMembers = $rules->allowedMembers ?? [];
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function setSelectedCourse()
    {
        $rules = (object) [
            'id' => $this->selectedCourse,
            'name' => Course::where('id', $this->selectedCourse)->first()->title
        ];
        array_push($this->ruleCourses, $rules);
        $this->selectedCourse = null;
    }

    public function deleteSelectedCourse($id)
    {
        $newRuleCourses = collect($this->ruleCourses)->filter(function ($item) use ($id) {
            return $item->id !== $id;
        })->toArray();

        $this->ruleCourses = $newRuleCourses;
    }

    public function setSelectedMember()
    {
        $rules = (object) [
            'id' => $this->selectedMember,
            'name' => User::where('id', $this->selectedMember)->first()->name
        ];
        array_push($this->ruleMembers, $rules);
        $this->selectedMember = null;
    }

    public function deleteSelectedMember($id)
    {
        $newRuleMembers = collect($this->ruleMembers)->filter(function ($item) use ($id) {
            return $item->id !== $id;
        })->toArray();

        $this->ruleMembers = $newRuleMembers;
    }

    public function submit()
    {
        $this->validate();
        try {
            $rules = [
                'member' => 'all',
                'course' => 'all',
                'minimumTransaction' => $this->minimumTransaction,
                'minimumOrder' => $this->minimumOrder,
            ];

            if (count($this->ruleMembers) > 0) {
                $rules['member'] = 'specified';
                $rules['allowedMembers'] = $this->ruleMembers;
            }

            if (count($this->ruleCourses) > 0) {
                $rules['course'] = 'specified';
                $rules['allowedCourses'] = $this->ruleCourses;
            }

            $payload = [
                'name' => $this->name,
                'description' => $this->description,
                'banner' => '',
                'code' => $this->code,
                'qty' => $this->qty,
                'valid_start' => $this->validStart,
                'valid_end' => $this->validEnd,
                'disc_off_price' => $this->discOffPrice,
                'disc_off_percent' => $this->discOffPercent,
                'rules' => json_encode($rules)
            ];
            VoucherService::update($payload, ['id' => $this->voucher->id]);
            return redirect()->route('dashboard.voucher.index')->with('success', 'Voucher updated successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to update voucher');
        }
    }

    public function render()
    {
        return view('livewire.pages.voucher.voucher-update-livewire');
    }
}
