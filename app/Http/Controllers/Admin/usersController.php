<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\triats\dataFilter;
use App\Http\Controllers\triats\Teacher;
use App\Http\Resources\qrCodeResource;
use App\Http\Resources\userResource;
use App\Models\Exam;
use App\Models\QrCode;
use App\Models\StudentViews;
use App\Models\User;

class usersController extends Controller
{
    private $filterData =[];
    use Teacher;
    use dataFilter;

    /**
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function fillTableUser()
    {
        //order column
        $columnsOrder = request('order')[0]['column'];
        $orderType = request('order')[0]['dir'];
        $orderColumn = request('columns')[$columnsOrder]['data'];
        /*======================================================================= */
        $CoursesObject = User::query()->where('student','=',1);
        if (!empty(request('filter'))) {
            $filterData = [];
            parse_str(html_entity_decode(request('filter')), $filterData);
            $this->filterData($filterData);
            $CoursesObject->where($this->filterData);
        }
        /*======================================================================= */
        // filtered data
        $filteredDataCount = $CoursesObject->count();
        /*======================================================================= */
        $recordsTotal = User::query()->where('student','=',1)->count();
        /*======================================================================= */
        $CoursesObject->skip(request('start'))
            ->take(request('length'))
            ->orderBy($orderColumn, $orderType);
        $storeEvents = $CoursesObject->get();
        /*======================================================================= */
        $storeEventsData = userResource::collection($storeEvents)
            ->additional([
                'draw' => intval(request('draw')),
                'recordsTotal' => $recordsTotal,
                'recordsFiltered' => $filteredDataCount,
            ]);
        return $storeEventsData;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  object  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->back()->with(['errorMessage'=>'User Banned']);
    }

    /**
     * @param User $user
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function viewUser(User $user)
    {
        $totalQrCodes = QrCode::where('student_id', '=', $user->id)->count();
        $totalEnrolledLessons = QrCode::where('student_id', '=', $user->id)->distinct('lesson')->count();
        $totalViews = StudentViews::where('student', '=', $user->id)->sum('views');
        return view('dashbord.students.view', ['user' => $user, 'totalQrCodes' => $totalQrCodes,
            'totalEnrolledLessons' => $totalEnrolledLessons, 'totalViews' => $totalViews]);
    }

    public function getviewspage()
    {
        return view('dashbord.students.lessons')->with('id', auth()->id());
    }

    /**
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function userQrCodes()
    {
        $authId = $this->getTeacherId();
        //order column
        $columnsOrder = request('order')[0]['column'];
        $orderType = request('order')[0]['dir'];
        $orderColumn = request('columns')[$columnsOrder]['data'];
        /*======================================================================= */
        $CoursesObject = QrCode::query()
            ->join('courses', 'qr_codes.lesson', '=', 'courses.id')
            ->select('courses.title', 'qr_codes.*')
            ->where('used','=',1)
            ->where('teacher_id','=',$authId['user_id']);
        if (!empty(request('filter'))) {
            $filterData = [];
            parse_str(html_entity_decode(request('filter')), $filterData);
            $this->filterData($filterData);
            $CoursesObject->where($this->filterData);
        }
        /*======================================================================= */
        // filtered data
        $filteredDataCount = $CoursesObject->count();
        /*======================================================================= */
        $recordsTotal = QrCode::where('teacher_id','=',$authId['user_id'])->where('used','=',1)->count();
        /*======================================================================= */
        $CoursesObject->skip(request('start'))
            ->take(request('length'))
            ->orderBy($orderColumn, $orderType);
        $storeEvents = $CoursesObject->get();
        /*======================================================================= */
        $storeEventsData = qrCodeResource::collection($storeEvents)
            ->additional([
                'draw' => intval(request('draw')),
                'recordsTotal' => $recordsTotal,
                'recordsFiltered' => $filteredDataCount,
            ]);
        return $storeEventsData;
    }

    /**
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function displayViews()
    {
        $authId = $this->getTeacherId();
        //order column
        $columnsOrder = request('order')[0]['column'];
        $orderType = request('order')[0]['dir'];
        $orderColumn = request('columns')[$columnsOrder]['data'];
        /*======================================================================= */
        $CoursesObject = StudentViews::query()
            ->join('courses', 'qr_codes.lesson', '=', 'courses.id')
            ->select('courses.title', 'qr_codes.*')
            ->where('used', '=', 1)
            ->where('teacher_id', '=', $authId['user_id']);
        if (!empty(request('filter'))) {
            $filterData = [];
            parse_str(html_entity_decode(request('filter')), $filterData);
            $this->filterData($filterData);
            $CoursesObject->where($this->filterData);
        }
        /*======================================================================= */
        // filtered data
        $filteredDataCount = $CoursesObject->count();
        /*======================================================================= */
        $recordsTotal = QrCode::where('teacher_id', '=', $authId['user_id'])->where('used', '=', 1)->count();
        /*======================================================================= */
        $CoursesObject->skip(request('start'))
            ->take(request('length'))
            ->orderBy($orderColumn, $orderType);
        $storeEvents = $CoursesObject->get();
        /*======================================================================= */
        $storeEventsData = qrCodeResource::collection($storeEvents)
            ->additional([
                'draw' => intval(request('draw')),
                'recordsTotal' => $recordsTotal,
                'recordsFiltered' => $filteredDataCount,
            ]);
        return $storeEventsData;
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function getStatics()
    {
        $user = Exam::where('')->get();
        return response()->json($user->toArray());
    }
}
