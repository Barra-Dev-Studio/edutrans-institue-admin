<?php

namespace App\Livewire\Pages\Transaction;

use App\Models\Course;
use App\Models\OwnedCourse;
use App\Models\Transaction;
use App\Models\TransactionDetail;
use App\Services\TransactionService;
use App\Traits\DatatableLivewire;
use DB;
use Livewire\Component;
use Livewire\WithPagination;
use Ramsey\Uuid\Uuid;

class AddTransactionManuallyLivewire extends Component
{
    use WithPagination, DatatableLivewire;
    public string|Course $model = Course::class;

    public mixed $id;

    public function mount(): void
    {
        $this->columns = [
            'id' => ['type' => 'text', 'label' => 'No'],
            'title' => ['type' => 'text', 'label' => 'Title'],
            'mentor.name' => ['type' => 'text', 'label' => 'Mentor'],
            'price' => ['type' => 'text', 'label' => 'Price'],
            'discount_price' => ['type' => 'text', 'label' => 'Discount price'],
        ];
    }

    protected function addTransaction()
    {
        $data = [
            'member_id' => $this->id,
            'ref_id' => Uuid::uuid4(),
            'total_item' => 1,
            'total_price' => 0,
            'total_disc' => 0,
            'total_payment' => 0,
            'status' => 'SUCCEEDED',
            'payment_response' => json_encode(['method' => 'Added manually']),
            'payment_method' => 'MANUAL',
            'callback_response' => null
        ];

        return Transaction::create($data);
    }

    protected function addTransactionDetail($transaction, $course)
    {
        $data = [
            'transaction_id' => $transaction->id,
            'item_id' => $course->id,
            'item_type' => 'course',
            'item_name' => $course->title,
            'price' => 0,
            'disc' => 0,
            'final_price' => 0,
        ];

        return TransactionDetail::create($data);
    }

    public function assign($courseId)
    {
        DB::beginTransaction();
        try {
            // Check if user already owned the course
            $ownedCourse = OwnedCourse::where('member_id', $this->id)->where('course_id', $courseId)->first();
            if ($ownedCourse !== null) {
                return redirect()->back()->with('error', 'User already had this course');
            }

            $course = Course::where('id', $courseId)->first();

            // add transaction first, then add transaction detail
            $transaction = $this->addTransaction();
            $this->addTransactionDetail($transaction, $course);

            // Assign the course
            TransactionService::addCourseToUserFromCallback($transaction->id, $courseId, $this->id);
            DB::commit();
            return $this->redirect(route('dashboard.user.show', $this->id));
        } catch (\Exception $err) {
            DB::rollback();
            return redirect()->back()->with('error', $err);
        }
    }

    public function render()
    {
        $data = $this->getData(new ($this->model));
        return view('livewire.pages.transaction.add-transaction-manually-livewire', [
            'data' => $data
        ]);
    }
}
