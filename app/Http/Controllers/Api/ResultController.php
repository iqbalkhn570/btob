<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Api\BaseController as BaseController;

use App\Http\Controllers\Controller;
use App\Models\Result;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator; 

class ResultController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    public function announce(Request $request )
    {
        # code...

        $validator = Validator::make($request->all(), [
            'date' => 'date_format:Y-m-d'
        ]);
     
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }

        $date = $request->date;

        $result = Result::select(
                        'results.id',
                        'results.product_id',
                        'results.brand_id',
                        'results.fetching_date',
                        'results.fetching_date_new',
                        'results.title',
                        'results.result_date',
                        'results.reference_number',
                        'results.prize1',
                        'results.prize2',
                        'results.prize3',
                        'results.special1',
                        'results.special2',
                        'results.special3',
                        'results.special4',
                        'results.special5',
                        'results.special6',
                        'results.special7',
                        'results.special8',
                        'results.special9',
                        'results.special10',
                        'results.consolation1',
                        'results.consolation2',
                        'results.consolation3',
                        'results.consolation4',
                        'results.consolation5',
                        'results.consolation6',
                        'results.consolation7',
                        'results.consolation8',
                        'results.consolation9',
                        'results.consolation10',
                    )
                    ->orderBy('fetching_date_new','DESC');
                    
        if($date)
            $result->whereFetchingDateNew($date);
            
        $result = $result->get();    
        return $this->sendResponse($result, 'result announce retrieved successfully.',['Date' => $date]);                   
    }
}
