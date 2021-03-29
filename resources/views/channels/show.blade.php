@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    {{$channel->name}}
                </div>

                <div class="card-body">
                    @if ($channel->editable())
                <form id="update-channel-form" action="{{route('channels.update',$channel->id)}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PATCH')
                        @endif

                    <div class="form-group row justify-content-center">
                        <div class="channel-avatar">
                            @if ($channel->editable())
                            <div onclick="document.getElementById('image').click()" class="channel-avatar-overlay">
                                
                                <svg id="Capa_1" fill="#fff" enable-background="new 0 0 512 512"
                                height="50"
                                viewBox="0 0 512 512" width="50"
                                xmlns="http://www.w3.org/2000/svg">
                               <g>
                                   <path
                                       d="m457 101h-100.188l-9.743-29.23c-6.136-18.405-23.293-30.77-42.692-30.77h-96.754c-19.399 0-36.556 12.365-42.691 30.77l-9.744 29.23h-24.188v-25c0-19.299-15.701-35-35-35h-20c-19.299 0-35 15.701-35 35v26.812c-23.568 6.208-41 27.698-41 53.188v260c0 30.327 24.673 55 55 55h402c30.327 0 55-24.673 55-55v-260c0-30.327-24.673-55-55-55zm-386-25c0-2.757 2.243-5 5-5h20c2.757 0 5 2.243 5 5v25h-30zm411 340c0 13.785-11.215 25-25 25h-402c-13.785 0-25-11.215-25-25v-260c0-13.785 11.215-25 25-25h111c6.456 0 12.188-4.131 14.23-10.257l13.162-39.486c2.046-6.135 7.764-10.257 14.231-10.257h96.754c6.467 0 12.186 4.122 14.23 10.256l13.162 39.487c2.043 6.126 7.775 10.257 14.231 10.257h111c13.785 0 25 11.215 25 25z"/>
                                   <circle cx="436" cy="176" r="15"/>
                                   <path
                                       d="m106 161h-30c-8.284 0-15 6.716-15 15s6.716 15 15 15h30c8.284 0 15-6.716 15-15s-6.716-15-15-15z"/>
                                   <g>
                                       <path
                                           d="m256 411c-74.439 0-135-60.561-135-135s60.561-135 135-135 135 60.561 135 135-60.561 135-135 135zm0-240c-57.897 0-105 47.103-105 105s47.103 105 105 105 105-47.103 105-105-47.103-105-105-105z"/>
                                   </g>
                                   <g>
                                       <path
                                           d="m256 351c-41.355 0-75-33.645-75-75s33.645-75 75-75 75 33.645 75 75-33.645 75-75 75zm0-120c-24.813 0-45 20.187-45 45s20.187 45 45 45 45-20.187 45-45-20.187-45-45-45z"/>
                                   </g>
                               </g>
                           </svg>
                               
                               
                            </div>

                            @endif

                            <img src="{{$channel->image()}}" alt="">  
            
                           
                        </div>
                        
                    </div>
                    <div class="form-group">
                       <h2 class="text-center">{{$channel->name}}</h2>
                       <p class="text-center">
                           {{$channel->description}}
                       </p>

                      <div class="text-center">
                       <subscribe-button :channel="{{$channel}}" :initial-Subscriptions="{{$channel->subscriptions}}" inline-template>
                        <button  @click="togglesubscription" class="btn btn-danger">
                            @{{owner ?'':subscribed?'Unsubscribe':'Subscribe'}} @{{subscriptions.length}} @{{owner?'subscriber':''}}
                        </button>
                       </subscribe-button>
                      </div>
                    </div>


                    @if ($channel->editable())
                    <input onchange="document.getElementById('update-channel-form').submit()" style="display: none" id="image" type="file" name="image">

                    <div class="form-group">
                        <label for="name" class="form-control-label">
                            Name
                        </label>
                    <input id="name" name="name" value="{{$channel->name}}" type="text" class="form-control">
                    </div>


                    <div class="form-group">
                        <label for="description" class="form-control-label">
                            Description
                        </label>

                        <textarea name="description" id="description"  rows="3" class="form-control">{{$channel->description}}
                        </textarea>
                    
                    </div>

                   
                     
                    @if ($errors->any())
                    <ul class="list-group mb-5">
                        @foreach($errors->all() as $error)
                        <li class="text-danger list-group-item">
                            {{$error}}
                        </li>
                        @endforeach
                    </ul>
                        
                    @endif

                    <button type="submit" class="btn btn-info">
                        Update Channel
                    </button>
                    @endif
                    @if ($channel->editable())
                   </form>
                   @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
