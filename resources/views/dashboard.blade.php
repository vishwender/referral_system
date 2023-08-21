@extends('layouts/dashboardLayout')
@section('content-section')
    <h6 style="cursor:pointer;" data-code="{{ Auth::user()->reference_code}}" class="copy"><span class="fa fa-copy mr-1"></span>Copy Reference Link</h6>
    <h2 class="mb-4" style="float:left">Dashboard</h2>
    <h2 class="mb-4" style="float:right">{{$networkCount * 10}} Points</h2>
    <table class="table">
        <thead>
            <tr>
                <th>S.No.</th>
                <th>Name</th>
                <th>Email</th>
                <th>Verified</th>
            </tr>
        </thead>
        <tbody>
            @if(count($networkData) > 0)
                @php $x = 1; @endphp
                @foreach($networkData as $network)
                    <tr>
                        <td>{{$x++}}</td>
                        <td>{{$network->user->name}}</td>
                        <td>{{$network->user->email}}</td>
                        <td>
                            @if($network->user->is_verified == 0 )
                                <b style="color:red">Unverified</b>
                            @else
                                <b style="color:green">Verified</b>
                            @endif
                        </td>
                    </tr>
                @endforeach
            @else
                <tr>
                    <th colspan="4">No Refferals</th>
                </tr>
            @endif
        </tbody>
    </table>
    <script>
        $(document).ready(function(){
            $('.copy').click(function(){
                $(this).parent().prepend('<span class="copied_text">Copied</span>');
               var code =  $(this).attr('data-code');
               var url = "{{ URL::to('/') }}/reference-register?ref=" + code;
               console.log(url);
               var temp = $("<input>");
               $("body").append(temp);
               temp.val(url).select();
               document.execCommand("copy");
               temp.remove();
                setTimeout(()=>{
                    $('.copied_text').remove();
                },2000);
            });
        });
    </script>
@endsection