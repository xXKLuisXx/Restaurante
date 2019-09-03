@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"></div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    Bienvenido!
                    @if (Auth::user())
                        @if(Auth::user()->roll==1)
                            <script>
                                window.location.replace("{{asset('ventasP')}}");
                            </script>
                        @elseif(Auth::user()->roll==2)
                            <script>
                                window.location.replace("{{asset('chef')}}");
                            </script>
                        @elseif(Auth::user()->roll==3)
                            <script>
                                window.location.replace("{{asset('repartidor')}}");
                            </script>
                        @elseif(Auth::user()->roll==0)
                            <script>
                                window.location.replace("{{asset('menu')}}");
                            </script>
                        @endif
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
