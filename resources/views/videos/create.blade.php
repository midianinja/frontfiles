@extends('layouts.app')

@section('content')
	<div class="bg-photo bg-create">
		 <!-- form-container -->
                <section class="form-container">
				    <drag-n-drop :videos="{{$videos}}"></drag-n-drop>
                </section><!-- form-container -->

                <!-- /modules -->
	</div>
               
@endsection