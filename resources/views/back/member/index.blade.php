
@extends('layouts.backmaster')

@section('include-css')

@endsection


@section('content')
    <div id="app">
        <div class="col-lg-8 col-md-8 ">
            <div class="card">
                <div class="header row">
                    <h4 class="col-xs-9 title">Team Members</h4>
                    <div class="col-xs-3 text-right">
                        <button class="btn btn-sm btn-warning btn-icon" @click="add"><i class="fa ti-plus"></i></button>
                    </div>
                </div>
                <div class="content">
                    <ul class="list-unstyled team-members">
                        <li v-for="user in users">
                            <div class="row">
                                <div class="col-xs-3">
                                    <div class="avatar">
                                        <img src="https://i.imgur.com/p7FWYkB.png" alt="Circle Image" class="img-circle img-no-padding img-responsive">
                                    </div>
                                </div>
                                <div class="col-xs-3">
                                    @{{ user.name }}
                                    <br>
                                    <span class="text-success"><small v-if="user.level==1">Admin</small><small v-if="user.level!=1">Admin</small></span>
                                </div>
                                <div class="col-xs-3">
                                    @{{ user.email }}
                                </div>

                                <div class="col-xs-3 text-right">
                                    <button class="btn btn-sm btn-success btn-icon"><i class="fa ti-pencil"></i></button>
                                    <button class="btn btn-sm btn-success btn-icon"><i class="fa ti-trash"></i></button>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <v-modal :title="edit.title"
                 :visible="edit.status"
                 ok-text="Submit"
                 cancel-text="Cancel"
                 @ok="handleOk"
                 @cancel="handleCancel"
        >

            <div class="col-12" v-if="edit">
                <div class="content">
                    <form>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Email address</label>
                                    <input type="email" class="form-control border-input" placeholder="Email">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Name</label>
                                    <input type="text" class="form-control border-input" placeholder="name">
                                </div>
                            </div>
                        </div>



                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Password</label>
                                    <input type="password" class="form-control border-input" placeholder="Password" >
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Level</label>
                                    <select class="form-control border-input" >
                                        <option>Admin</option>
                                        <option>Member</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                    </form>
                </div>
            </div>
        </v-modal>
    </div>




@endsection


@section('js',asset('js/member.js'))
@section('include-javascript')
@endsection