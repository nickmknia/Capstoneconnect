@extends('layouts.master')

@section('title')
@parent
@stop

@section('styles')

@stop

@section('head')
<script>
    $(document).ready(function() 
      { 
        $('#AverageGrades').dataTable(
        
        
        ); 
      } 
    ); 
</script>    
@stop

@section('header')
<h1>Average Grades</h1>
@stop



@section('content')


<?php $user = Sentry::getUser();
//Finds the current user ^^^
//echo $user['email'];

?>
<p><font size ='5'>Average Grade per User</font></p>
<?php $users = User::all();
 $evalID = DB::table('evaluations')->lists('id', 'id');
//$grades1 = DB::table('students')->lists('grades1', 'id');

?>


<!-- Table starts here -->

<!--<div class="table-responsive">
 <table id="AverageGrades" class="table table-bordered table-groups" >
-->
<table id="AverageGrades" class="display">
<thead>
 <tr bgcolor="Black">

                   <th><font color="White">First Name</th></font>
                   <th><font color="White">Last Name</th></font>
                   <th><font color="White">Email</th></font>
                   <th> <font color="White">Average Grade</th></font>
        
                     
                  </tr>
</thead>

<tbody>                     
@foreach ($users as $user)



<?php
//Current solutuion to the questionaire.
//$temp = DB::table('answers')->join('users', 'answers.answered_about', '=', 'users.id')
  //  ->avg('ans1', 'ans2')->where('users.id','=',$user->id)->get();
//$price = DB::table('answers')->where('answered_about', '=', $user->id)->avg('ans1', 'ans2', 'ans3', 'ans4');


$a1 = DB::table('answers')->where('answered_about', '=', $user->id)->avg('ans1');
$a2 = DB::table('answers')->where('answered_about', '=', $user->id)->avg('ans2');
$a3 = DB::table('answers')->where('answered_about', '=', $user->id)->avg('ans3');
$a4 = DB::table('answers')->where('answered_about', '=', $user->id)->avg('ans4');
$a5 = DB::table('answers')->where('answered_about', '=', $user->id)->avg('ans5');
$a6 = DB::table('answers')->where('answered_about', '=', $user->id)->avg('ans6');
$a7 = DB::table('answers')->where('answered_about', '=', $user->id)->avg('ans7');
$a8 = DB::table('answers')->where('answered_about', '=', $user->id)->avg('ans8');
$a9 = DB::table('answers')->where('answered_about', '=', $user->id)->avg('ans9');
$a10 = DB::table('answers')->where('answered_about', '=', $user->id)->avg('ans10');
$avg = ($a1 + $a2 + $a3 + $a4 + $a5 + $a6 + $a7 + $a8 + $a9 + $a10)/10;   //Averages all a1-a10
?>
   

                     
                          
                         <tr >
                            <td>{{$user->first_name}}</td>
                            <td>{{$user->last_name}}</td>
                            <td>{{$user->email}}</td>
                            <td>{{$avg}}</td>  
                        
                        </tr>

@endforeach  
</tbody>

</table>

</div>
    
@stop
