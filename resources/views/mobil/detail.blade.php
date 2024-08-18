@extends('layouts.app')

@section('title', 'Detail Mobil')

@section('content')
<div class="col-sm-12">
           <div class="card" style=" width: 65%">
               <div class="card-body">
                   <div class="row">
                        <div class="col-md-5">
                            @if ($mobil->image)
                            <img style="width: 300px" src="{{ asset('storage/'. $mobil->image) }}" >
                            @else
                            <img style="width: 250px" src="" >
                            @endif
                        </div>
                        <div class="col-md-7">
                            <table class="table">

                                <tr>
                                    <td>Nopol</td>
                                    <td>:</td>
                                    <td>{{ $mobil->nopol }}</td>
                                </tr>
                                <tr>
                                    <td>Jurusan</td>
                                    <td>:</td>
                                    <td>{{ $mobil->jurusan }}</td>
                                </tr>


                            </table>
                        </div>
                   </div>
                   <a href="/mobil" class="btn btn-success btn-sm" >
                    Back
                </a>
               </div>
           </div>
        </div>
@endsection
