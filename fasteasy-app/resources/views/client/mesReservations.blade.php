@extends('layouts.template')
@section('style')
    <style>
        .btn3{
            background-color: #ffc107;
            color: white;
        }
        .btn3:hover{
            color: #2a3342;
        }

    </style>
@endsection
@section('menu')
    @include('layouts.menuClient')
@endsection
@section('content')
    <div class="container" style="margin-top: 150px;margin-bottom: 150px; height: 100%;">
        <h3>Mes reservations / nombre {{ $data->count() }}</h3>
          <center>
        <table  class="table" style="width: 750px; margin-top: 40px;">
            <thead class="table-dark" >
                <th style="font-size: 20px; text-align: center;">Date/heure</th>
                <th style="font-size: 20px; text-align: center;">Etat</th>
                <th style="font-size: 20px; text-align: center;">Consulter l'annonce</th>
            </thead>
            @foreach($data as $resev)
                <tr style="height: 50px;">
                    <td ><span style="color: #2a3342; font-size: 20px; text-align: center;">{{$resev->created_at}}</span></td>

                    <?php if($resev->confirmer==1) :?>
                    <td style="color: #2a3342; font-size: 20px ; text-align: center;" >Confirme</td>
                    <?php else : ?>
                    <td style="color: #2a3342; font-size: 20px; text-align: center;" >Non Confirme</td>
                    <?php endif ;?>

                    <td><a href="/consulterAnnonce/{{$resev->id_annonce}}"><button class="btn-success btn btn-md" style="margin-left: 120px; width: 80px;">VOIR</button> </a></td>

                </tr>

            @endforeach
        </table>
          </center>
    </div>
@endsection
@section('style')
       <style>
            th td{
                width: 160px;
                text-align: center;
            }
           tr{
               height: 50px;
               padding: 5px 5px 5px 30px;
               background-color: white;
           }
           th{
               font-weight: 800;
               font-size: 30px;
           }
           td{
               color: #2a3342;
               font-size: 25px;
           }
       </style>
@endsection