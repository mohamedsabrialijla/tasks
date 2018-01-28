@extends("layouts.layout")
<style type="text/css">
    <style type="text/css">
        .text-right {
            text-align: left !important;
        }
        .tabel td{
            text-align: left !important; 
        }
    </style>
</style>
@section("content")
 
    <div class="row">
        <div class="col-sm-12">
            <div class="element-wrapper">
                <div class="os-tabs-controls">
                            <ul class="nav nav-tabs smaller">
                                <li class="nav-item">
                                    <h6> Taskes </h6>
                                </li>
                            </ul>
                            <ul class="nav nav-pills smaller hidden-sm-down">
                                <div class="col-sm-6" style="margin-top: -17px;">
                                   <a class="btn btn-primary pull-right" href="{{url('/task/create')}}">Add New Task</a>
                                </div>
                            </ul>
                        </div>

                <div class="element-box">
                @if (count($errors) > 0)
                            <div class="alert alert-danger">
                                <strong>{{'Error'}}!</strong>{{' Wrong data entry'}}<br>
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                            @endif
                            @if (session('success'))
                                <div class="alert alert-success">
                                    {{ session('success') }}
                                </div>
                            @endif

                            @if (session('falis'))
                                <div class="alert alert-danger">
                                    {{ session('falis') }}
                                </div>
                            @endif
                    <div class="table-responsive">
                        <table class="table table-lightborder">
                            <thead>
                            <tr>
                                <th>
                                     Name
                                </th>
                                <th>
                                    List
                                </th>
                                <th>
                                    Due
                                </th>
                                <th class="text-center">
                                    Status
                                </th>
                                <th class="text-center">
                                    Actions
                                </th>
                                
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($results as $task)
                            <tr>
                                <td class="nowrap">
                                    {{$task->name}}
                                </td>
                                <td class="text_left">
                                    {{$task->list}}
                                </td>
                                <td class="text-left">
                                    {{$task->due}}
                                </td>
                                <td class="text-center">
                                @if($task->status == 1)
                                    <div class="status-pill green" data-title="Complete"
                                         data-toggle="tooltip"></div>
                                @elseif($task->status == 2)
                                <div class="status-pill yellow" data-title="Complete"
                                         data-toggle="tooltip"></div>
                                @else 
                                <div class="status-pill " data-title="Complete"
                                         data-toggle="tooltip"></div>

                                @endif
                                </td>

                                <td class="row-actions">
                                    <a href="{{url('/task/'.$task->id.'/edit')}}"><i class="os-icon os-icon-ui-49"></i></a>
                                    <a class="danger"  href="{{url('/task/'.$task->id.'/delete')}}"><i class="os-icon os-icon-ui-15"></i></a>
                                </td>
                            </tr>
                             @empty
                             @endforelse

                            </tbody>
                            {{$tasks->links()}}
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop