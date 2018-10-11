<?php

namespace App\Http\Controllers;

use App\Apis\ApiService;
use Illuminate\Http\Request;
use Illuminate\Support\MessageBag;
use Validator;


class ShipmentController extends Controller
{

    /**
     * Return home view
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('welcome');
    }


    /**
     * Get info for a specific shipment
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Throwable
     */
    public function getData(Request $request)
    {
        //validate request
        $validator = Validator::make($request->all(), [
            'shipment_code' => 'required',
        ]);
        //render errors or data
        if($validator->fails()){
            $responseView = $this->renderErrorsView($validator->errors());
        }else{
            $responseView = $this->renderShipmentView($request->shipment_code);
        }

        return response()->json([
            'view' => $responseView
        ]);
    }

    /**
     * Return errors in a rendered view
     * @param $errors
     * @return string View
     * @throws \Throwable
     */
    private function renderErrorsView($errors)
    {
        $view = view('errors', ['errors' => $errors])->render();
        return $view;
    }

    /**
     * Return data or errors in a rendered view
     * @param $shipmentCode
     * @return string Shipment Data
     * @throws \Throwable
     */
    private function renderShipmentView($shipmentCode)
    {
        //get shipment data via Api
        $shipmentData = ApiService::getShipmentData($shipmentCode);
        //render JSON error/data views
        if(isset($shipmentData['errors'])){
            $errors = $this->addErrors($shipmentData);
            $view = $this->renderErrorsView($errors);
        }else{
            //render data view
            $view = view('shipmentData', ['shipmentData' => (object) $shipmentData['data']])->render();
        }
        return $view;
    }

    /**
     * Add JSON errors to Laravel Validation errors
     * @param JSON $shipmentData
     * @return MessageBag $errors
     */
    private function addErrors($shipmentData)
    {
        $errors = new MessageBag();
        $errorMessage = $shipmentData['errors'][0]['message'];
        // adding JSON ERROR
        $errors->add('shipment_error', __($errorMessage));
        return $errors;
    }
}
