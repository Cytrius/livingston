@extends('layouts.livingstonapp')

@section('content')

	<link href="https://cdnjs.cloudflare.com/ajax/libs/flatpickr/2.5.7/flatpickr.min.css" rel="stylesheet">

	<script src="https://cdnjs.cloudflare.com/ajax/libs/flatpickr/2.5.7/flatpickr.min.js"></script>

	<style>
		.lead-gen-form {
			   margin: 0px;
		    padding: 0px;
		    margin-left: auto;
		    margin-right: auto;
		    max-width: 1000px;
		    width: 85%;
		    font-size: 15px;
		    line-height: 20px;
		    color: #7F8992;
		    margin-top:2em;
		    margin-bottom:2em;
		}
	</style>

	<div class="lead-gen-form">

	    <!-- Application Container -->
	    <h1>Import Rate Tables</h1>

	    <form action="/import" method="post" enctype="multipart/form-data">

	    	<input type="file" name="file"><br/>
	    	<label><input type="checkbox" value="truncate" name="truncate"> Delete all existing records?</label><br/><br/>

	    	<button type="submit" class="lead-gen-button">Import</button>
	    	<br/><br/>

	    </form>

    </div>
@endsection
