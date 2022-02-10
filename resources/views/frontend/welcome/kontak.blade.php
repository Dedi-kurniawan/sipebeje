@section('title', $bread['first'])
@extends('layouts.frontend.master')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <h4 class="page-title">{{ $bread['first'] }}</h4>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <p>
                    <h3>Hoc enim constituto in philosophia constituta sunt omnia.</h3>
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quae duo sunt, unum facit.<br>
                    Istam voluptatem perpetuam quis potest praestare sapienti?<br> Qui ita affectus, beatum esse numquam
                    probabis;
                    </p>
                    <ul class="mt-4" style="list-style: none;">
                        <li><i class="fe-facebook"></i> facebook.com/sipebeje</li>
                        <li><i class="fe-twitter"></i> twitter.com/sipebeje</li>
                        <li><i class="fe-instagram"></i> instagram.com/sipebeje</li>
                        <li><i class="fe-phone"></i> 081234567893</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection