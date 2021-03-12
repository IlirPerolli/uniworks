<div class="col-md-3" id="posts-preferences">
    <h5>Preferencat</h5>
    <form method="GET" action="{{route('search.posts')}}">

        <div class="form-group mt-4">
        <label for="sort-posts">Rendit nga</label>
        <select class="preferences-options form-control" id="sort-posts" name="order">
{{--            <option>...</option>--}}
            <option value="desc" @if (isset($_GET['order'])) {{$_GET['order'] == 'desc' ? 'selected' : ''}} @endif>Postimi më i ri</option>
            <option value="asc" @if (isset($_GET['order'])) {{$_GET['order'] == 'asc' ? 'selected' : ''}} @endif>Postimi më i vjetër</option>
        </select>
    </div>

    <div class="form-group mt-4">
        <label for="sort-posts">Viti</label>
        <select class="preferences-options form-control" name="year" id="sort-posts-by-year" onchange="checkYear();">
{{--            <option>...</option>--}}
            <option value="" >Çdo kohë</option>
            <option value="2021" @if (isset($_GET['year'])) {{$_GET['year'] == '2021' ? 'selected' : ''}} @endif>Që nga 2021</option>
            <option value="2020" @if (isset($_GET['year'])) {{$_GET['year'] == '2020' ? 'selected' : ''}} @endif>Që nga 2020</option>
            <option value="2017" @if (isset($_GET['year'])) {{$_GET['year'] == '2017' ? 'selected' : ''}} @endif>Që nga 2017</option>
            <option value="custom" @if (!isset($_GET['year'])) {{'selected'}} @endif>Custom</option>
        </select>
        <br>
        <div id="custom_year_inputs">
        <input type="number" id="startyear" name="startyear" min="1900" max="2021" required disabled> -
        <input type="number" id="endyear" name="endyear" min="1900" max="2021" required disabled>
        </div>
    </div>
    <input type="hidden" name="q" value="{{$_GET['q']}}">
    <div class="save-preferences">
        <button class="save-preferences-btn btn" type="submit" onclick="checkPreferences()">
            <h6>Ruaj</h6>
        </button>
    </div>

</form>

</div>
@section('scripts')
<script>

    function checkYear() {
        var selectBox = document.getElementById("sort-posts-by-year");
        var selectedValue = selectBox.options[selectBox.selectedIndex].value;
        if (selectedValue == 'custom'){
            document.getElementById("custom_year_inputs").style.display = "block";
            $('#startyear').prop('disabled',false);
            $('#endyear').prop('disabled',false);
        }
        else{
            document.getElementById("custom_year_inputs").style.display = "none";
            $('#sort-posts-by-year').prop('disabled',false);
        }
    }
    function checkPreferences() {
        var selectBox = document.getElementById("sort-posts-by-year");
        var selectedValue = selectBox.options[selectBox.selectedIndex].value;
        var startyear = document.getElementById("startyear").value;
        var endyear = document.getElementById("endyear").value;

        if (selectedValue == 'custom' && (startyear!='') && (endyear!='') ){

            $('#sort-posts-by-year').prop('disabled',true);
        }

    }
</script>
@endsection
