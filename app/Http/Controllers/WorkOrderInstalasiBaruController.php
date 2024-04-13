<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WorkOrderInstalasiBaruController extends Controller
{
    public function index()
    {
        $page_title = "Work Order - Instalasi Baru";
        // $lists      = ItemRequest::with([
        //     'createdBy',
        //     'approvalBy'
        // ])->where('status', 'pending')->orderBy('id', 'desc')->get();

        $data = [
            'page_title' => $page_title,
            // 'lists'      => $lists
        ];
        return view('pages.work_order.main', $data);
    }

    public function create()
    {
        $page_title = "Work Order - Create Instalasi Baru";
        // $lists      = ItemRequest::with([
        //     'createdBy',
        //     'approvalBy'
        // ])->where('status', 'pending')->orderBy('id', 'desc')->get();

        $data = [
            'page_title' => $page_title,
            // 'lists'      => $lists
        ];
        return view('pages.work_order.form', $data);
    }
}
