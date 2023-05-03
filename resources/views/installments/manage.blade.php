@extends('layouts.layout')

@section('content')
<div class="row">
    <div class="col-xl-12">
        <div id="panel-1" class="panel">
            <div class="panel-hdr">
                <h2>
                    Manage  <span class="fw-300"><i>Installment</i></span>
                </h2>
                <div class="panel-toolbar">
                    <button class="btn btn-panel" data-action="panel-collapse" data-toggle="tooltip" data-offset="0,10" data-original-title="Collapse"></button>
                    <button class="btn btn-panel" data-action="panel-fullscreen" data-toggle="tooltip" data-offset="0,10" data-original-title="Fullscreen"></button>
                    <button class="btn btn-panel" data-action="panel-close" data-toggle="tooltip" data-offset="0,10" data-original-title="Close"></button>
                </div>
            </div>
            <div class="panel-container show">
                <div class="panel-content">
                    <!-- datatable start -->
                    <table id="dt-basic-example" class="table table-bordered table-hover table-striped w-100">
                        <thead>
                            <tr>
                                <th colspan="2">
                                    <div class="row">
                                        @php
                                            $down_payment = 0;
                                            $id = 0;
                                        @endphp
                                        <div class="col-md-6">
                                            <span class="text-info">Customer Name</span>
                                            <h5 class="text-primary">
                                                {{ $installment->name ?? "Not Given" }}
                                            </h5>
                                            <span class="text-info">Total Amount</span>
                                            <h5 class="text-primary">
                                                {{ $installment->booking->total_amount ?? 0.00 }}
                                            </h5>
                                        </div>
                                        <div class="col-md-6">
                                            <span class="text-info">Register No</span>
                                            <h5 class="text-primary">
                                                # {{ $installment->booking->id ?? "##" }}
                                            </h5>
                                            <span class="text-info">Plot No</span>
                                            <h5 class="text-primary">
                                                {{ $installment->booking->plot->name  ?? 'Not Given' }}
                                            </h5>
                                        </div>
                                    </div>
                                </th>
                                <th colspan="2">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <span class="text-info">Paid Amount</span>
                                            <h5 class="text-primary">
                                                {{ $installment->booking->total_amount - $installment->booking_orders->total_amount }}
                                            </h5>

                                            <span class="text-info">Payable Amount</span>
                                            <h5 class="text-primary">
                                                {{ $installment->booking_orders->total_amount ?? 0.00 }}
                                            </h5>
                                        </div>
                                        <div class="col-md-4">
                                            <span class="text-info">Block</span>
                                            <h5 class="text-primary">
                                                {{ $installment->booking->plot->block->name ?? 'Not Given' }}
                                            </h5>

                                            <span class="text-info">Plot Size</span>
                                            <h5 class="text-primary">
                                                {{ $installment->booking->plot->size ?? 'Not Given' }}
                                            </h5>
                                        </div>
                                        @php
                                            $total = $down_payment;
                                        @endphp
                                        <div class="col-md-4">
                                            <a href="{{ route('installment.all.invoices',$installment->id) }}" class="btn btn-sm btn-primary float-right mb-3">All Invoice</a>
                                            <a href="{{ route('installment.payment') }}" class="btn btn-sm btn-primary float-right">New Installment</a>
                                        </div>
                                    </div>
                                </th>
                            </tr>
                            <tr>
                                <th>Recipt No</th>
                                <th>Installment Amount</th>
                                <th>Installment Date</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (isset($installment))
                                {{-- @foreach ($installment as $row) --}}
                                @foreach ($installment->installments as $irow)
                                    <tr>
                                        <td>{{ $irow->id }}</td>
                                        <td>{{ $irow->installment_amount }}</td>
                                        <td>{{ $irow->created_at }}</td>
                                        <th>
                                            <a href="/get_unique_invoice/{{ $irow->id }}/{{ $installment->id }}" class="btn btn-info btn-sm">View</a>
                                            <a href="/installment/delete/{{ $irow->id }}/{{ $installment->id }}" class="btn btn-sm btn-danger">Delete</a>
                                            <a href="{{ route('admin.edit_customer_installment',$irow->id) }}" class="btn btn-sm btn-primary ml-2">Edit</a>
                                        </td>
                                    </tr>
                                @endforeach
                                {{-- @endforeach --}}
                            @endif

                        </tbody>
                        <tfoot>
                            <tr>
                                <th>Recipt No</th>
                                <th>Installment Amount</th>
                                <th>Installment Date</th>
                                <th>Action</th>
                            </tr>
                        </tfoot>
                    </table>
                    <!-- datatable end -->
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
