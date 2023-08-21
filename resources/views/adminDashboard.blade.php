@extends('layouts/adminDashboardLayout')
@section('content-section')
    <h2 class="mb-4" style="float:left">Admin Dashboard</h2>
    <table class="table">
        <thead>
            <tr>
                <th>S.No.</th>
                <th>Name</th>
                <th>Email</th>
                <th>Verified</th>
                <th>Reference Code</th>
                <th>Reward Points</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @if(count($userData) > 0)
                @php $x = 1; @endphp
                @foreach($userData as $users)
                    <tr>
                        <td>{{$x++}}</td>
                        <td>{{$users->name}}</td>
                        <td>{{$users->email}}</td>
                        <td>
                            @if($users->is_verified == 0 )
                                <b style="color:red">Unverified</b>
                            @else
                                <b style="color:green">Verified</b>
                            @endif
                        </td>
                        <td>{{$users->reference_code}}</td>
                        
                        @foreach($rewardsCount as $count)
                            @if($users->id == $count->parent_user_id && $count->count > 0)
                                <td>{{$count->count * 10}} Points</td>
                            @else
                                <td>No Rewards</td>    
                            @endif    
                        @endforeach
                        <td><button class="delete-button" data-item-id="{{$users->id}}">Delete</button></td>
                    </tr>
                @endforeach
            @else
                <tr>
                    <th colspan="4">No Refferals</th>
                </tr>
            @endif
        </tbody>
    </table>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function(){
            $('.delete-button').on('click', function(){
                var itemId = $(this).data("item-id");
                
                $.ajax({
                    url: "{{route('admindelete')}}",
                    method:"GET",
                    data:{id: itemId},
                    success: function(response){
                        alert('User Deleted Successfully');
                    },
                    failure: function(xhr, status, error){
                        alert("An error occurred while deleting the item.");
                        console.log(error);
                    }

                });
            });
        });
    </script>
@endsection