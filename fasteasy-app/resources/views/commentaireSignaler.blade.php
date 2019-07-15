



<div class="col-md-9">
    <div class="profil-content">
           <p>de :<a href="/whoComments/{{$userfrom->id}}">{{$userfrom->login}}</a><br></p>
             <p>son commentaire: {{$commentaire->avisNegative}}<br>{{$commentaire->avisPositive}}</p>
            <p> a : <a href="/whoComments/{{$userfrom->id}}">{{$userto->login}} </a></p><br>
            <br> <a href="/SupprimerCommentaire/{{$commentaire->id}}" class="btn btn-danger" >Supprimer</a>
    </div>
</div>
