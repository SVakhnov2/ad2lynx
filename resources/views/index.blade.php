<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
{{--    Якась ідіотська проблема встановити бутстрап нормально через composer, більше часу витратив на пошук фіксу ніж написання коду--}}
</head>
<body>
<div class="container">
    <div>
        <div class="input-group input-group-sm mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text" id="inputGroup-sizing-sm">search</span>
            </div>
            <input type="text" class="form-control" aria-label="Small" aria-describedby="inputGroup-sizing-sm" id="searchInput">
        </div>
    </div>
    <div>
        <table class="table">
            <thead>
            <tr>
                <th scope="col">ad_id</th>
                <th scope="col">Impressons</th>
                <th scope="col">Clicks</th>
                <th scope="col">Unique clicks</th>
                <th scope="col">Leads</th>
                <th scope="col">Conversion</th>
                <th scope="col">Roi</th>
            </tr>
            </thead>
            <tbody>
            @foreach($data as $d)
            <tr id="{{$d['ad_id']}}">
                <th scope="row">{{$d['ad_id']}}</th>
                <td>{{$d['impressions']}}</td>
                <td>{{$d['clicks']}}</td>
                <td>{{$d['unique_clicks']}}</td>
                <td>{{$d['leads']}}</td>
                <td>{{$d['conversion']}}</td>
                <td>{{$d['roi']}}</td>
            </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>
<script>
    document.getElementById('searchInput').addEventListener('keyup', function() {
        let searchQuery = this.value.toLowerCase();
        let rows = document.querySelectorAll('.table tbody tr');

        rows.forEach(row => {
            let ad_id = row.firstElementChild.textContent.toLowerCase();
            if(ad_id.indexOf(searchQuery) > -1) {
                row.style.display = "";
            } else {
                row.style.display = "none";
            }
        });
    });
</script>
</body>
</html>
