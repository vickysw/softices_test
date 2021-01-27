<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
            <div class="container">
                <form action="{{ route('slot_save')}}" method="post">
                @csrf()
                @method('post')
                <div class="mt-4">
                    @if (Auth::user()->role === 1)
                    {{ Auth::user()->name}}
                        <select class="block mt-1 w-full" name="slot_available">
                            <option value="">Select Slots</option>
                            <option value="0.5" {{ Auth::user()->slot_time=="0.5" ? 'selected':'' }}>0.5</option>
                            <option value="1" {{ Auth::user()->slot_time=="1" ? 'selected':'' }}> 1</option>
                        </select>
                        </div>

                        <x-jet-label value="{{ __('Available From') }}" />
                        <input type="time" placeholder="Available from " name="available_from" value="{{Auth::user()->slot_time }}">
                        <x-jet-label value="{{ __('Available To') }}" />
                        <input type="time" placeholder="Available to " name="available_to" value="{{Auth::user()->slot_time }}">
                        <x-jet-button class="ml-4">
                        {{ __('Save') }}
                    </x-jet-button>
                    @else
                        <select class="block mt-1 w-full doctor" name="doctor_name" >
                        <option value="">Select doctor</option>
                            
                        @foreach($user as $key=>$value)
                            <option value="{{ $value->id}}">{{ $value->name}}</option>
                        @endforeach
                        </select>
                        <div class="slot_html"> No slot Available</div>
                    @endif
                    </div>
                </form>
            </div>
            </div>
        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" integrity="sha512-bLT0Qm9VnAYZDflyKcBaQ2gg0hSYNQrJ8RilYldYQ1FxQYoCLtUjuuRuZo+fjqhx/qtq/1itJ0C2ejDxltZVFg==" crossorigin="anonymous"></script>
    <script type="text/javascript">
            $(document).on("change",".doctor",function(e)
            {
               
                var _token = $("input[name='_token']").val();
                var doctor_id = $(this).val();
             
                $.ajax({
                    url: "{{ route('getslot') }}",
                    type:'POST',
                    data: {_token:_token, doctor_id:doctor_id},
                    success: function(data) {
                         console.log('DATA',data);
                         var html = '<ul class="list-inline">';
                         if(data != ''){
                            $(data).each(function(d,k){
                                console.log('d',d);
                                console.log('k',k);
                                if(k.is_available == 1)
                                    html +='<li class="list-inline-item"><a href="javascript:booked('+k.id+')">'+k.start_time+'</a></li>';
                                else    
                                    html +='<li style="color:red" class="list-inline-item red">'+k.start_time+'</li>';
                            });
                          
                         }else{
                            html += '<li>No slot available</li>';
                         }
                         html += '</ul>';
                        $('.slot_html').html(html);
                    }
                });
            });

        function booked(id)
        {
            if (confirm('Click on OK and Booked the appointment')) {
            var _token = $("input[name='_token']").val();
            $.ajax({
                    url: "{{ route('bookslot') }}",
                    type:'POST',
                    data: {_token:_token, id:id},
                    success: function(data) {
                        location.reload();
                    }
                });
            }
        }
    </script>
</x-app-layout>
