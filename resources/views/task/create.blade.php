@extends("layouts.layout")
@section("content")

    <div class="row">
        <div class="col-sm-12">
            <div class="element-wrapper">
                <h6 class="element-header">
                    Add New Task
                </h6>
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
                    <form class="form-horizontal" method="post" action="{{url('/task')}}" >
                    {{csrf_field()}}

                    <div class="form-group">
                        <label class="col-sm-2 control-label">Name</label>
                        <div class="col-sm-10">
                            <input type="text" name="name"
                                   value="" required
                                   class="form-control"
                                   placeholder="discount">
                                   <small>{{"* required"}}</small>
                        </div>
                    </div>


                    <div class="form-group">
                        <div class="col-md-2" style="float: left;text-align: right">
                            <label> Due</label>
                        </div>
                        <div class="col-md-10">
                            <div class="input-group container">
                                <div class="input-group-addon">
                                    <i class="fa fa-clock-o"></i>
                                </div>
                                <input type="text" class="form-control pull-right" name="due" value="" 
                                       id="datepicker">
                            </div>
                            
                        </div>
                    </div>

                  

                    <div class="form-group">
                        <label class="col-sm-2 control-label">List</label>
                        <div class="col-sm-10">
                            <input type="text" name="list"
                                   value="" required
                                   class="form-control"
                                   placeholder="list">
                                   <small>{{"* required"}}</small>
                        </div>
                    </div>

                    <div class="form-group" >
                        <label class="col-sm-2 control-label">{{"Select Inquiry: "}}</label>
                        <div class="col-sm-10">
                            <select name="inquiry_id" class="select2 form-control" style="width: 100%">
                                <option value="">{{"Select Inquiry"}}</option>
                                
                                    <option value="1"> Inquiry_1 </option>
                                    <option value="2"> Inquiry_2 </option>
                                    <option value="3"> Inquiry_3 </option>
                                    <option value="4"> Inquiry_4 </option>
                                    <option value="5"> Inquiry_5 </option>
                            </select>
                        </div>
                    </div>


                    <div class="form-group" >
                        <label class="col-sm-2 control-label">{{"Select User: "}}</label>
                        <div class="col-sm-10">
                            <select name="user_id" class="select2 form-control" style="width: 100%">
                                <option value="">{{"Select User"}}</option>
                                @foreach($users as $user)
                                    <option value="{{$user->id}}">
                                    {{$user->name}}
                                    </option>
                                @endforeach    
                            </select>
                        </div>
                    </div>


                        <div class="form-group">
                            <label class="col-sm-2 control-label">Note</label>
                            <div class="col-sm-10">
                                <textarea name="note" value="" rows="3" class="form-control"
                                       placeholder="notes"></textarea>
                            </div>
                        </div>

                        <div class="form-group">
                        <label class="col-sm-2 control-label">Status</label>
                        <div class="col-sm-10">
                            <div>
                                <input type="radio" name="status" value="active"> Active<br>
                                <input type="radio" name="status" value="complete"> Complete<br>
                            </div>
                        </div>
                    </div>



                   

                    <div class="box-footer">
                        <button type="submit" class="btn btn-primary pull-right">Submit</button>
                    </div>

                    </form>    
                </div>
            </div>
        </div>
    </div>

@stop