

@if(Session::has('message'))
    {{ Session::get('message')}}
@endif
 <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
 {{HTML::script('js/functions.js')}}
<br>
<script type="text/javascript">
    $(document).on('ready', function(){

            $("#fname,#lname").keyup( function(){
// $.change() detects user input

var lname = ""; // create your variables
var fname = ""; 

if($("#fname").val()!=""){
fname = $("#fname").val().toLowerCase().replace(/ +/g,'_').replace(/[ñ]/g,'n').replace(/[^a-z0-9-_]/g,'').trim();
}
//if the fname field is not empty

if($("#lname").val()!=""){
lname = $("#fname").val().toLowerCase().replace(/ +/g,'_').replace(/[0-9]/g,'').replace(/[^a-z0-9-_]/g,'').trim();
} 
//if the lname field is not empty

$('#user_url').val(fname+"-"+lname); 
}); 
    });
</script>
@if (!empty($data))
    Hello, {{{ $data['name'] }}}
    {{HTML::image($data['photo'])}} 
    <!--<img src="{{ $data['photo']}}">-->
    <br>
    Your email is {{ $data['email']}}
    <br>
    <a href="logout">Logout</a>

    <br>

   

    <br>
    @if(Session::has('dato'))
        {{ Session::get('dato')}} <br>
        <p>Esta es mi variable de sesión</p>
        <form action="{{URL::route('session-quitar')}}" method="post">
        <input type="hidden" name="miDato" value="1" required>

        <input type="submit" value="Eliminar Variable">
        {{Form::token()}}
    </form>


    @else
    <form action="{{URL::route('session1')}}" method="post">
        <input type="text" name="miDato" required>

        <input type="submit" value="crear variable">
        {{Form::token()}}
    </form>

    @endif
  
    <!--<input id="fname" name="fname">
<input id="lname" name="lname">
<input id="user_url" name="user_url"> -->
@else

    Hi! Would you like to <a href="login/fb">Login with Facebook</a>?

    <div id="objetos">
    	
    </div>

@endif