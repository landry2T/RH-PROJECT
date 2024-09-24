@extends('layouts.app')

@section('content')
<main class="app-content">
  <div class="app-title">
    <div>
      <h1><i class="bi bi-speedometer"></i> Tableau de bord</h1>
      <p>vous êtes dans votre session</p>
    </div>
    <ul class="app-breadcrumb breadcrumb">
      <li class="breadcrumb-item"><i class="bi bi-house-door fs-6"></i></li>
      <li class="breadcrumb-item"><a href="#">Tableau de bord</a></li>
    </ul>
  </div>
  <div class="row">
    <div class="col-md-12">
      <div class="tile">
        <div class="tile-body">
          <h3><i class="bi bi-clipboard-check-fill"></i> NOTES DE SERVICE</h3>
          <div style="float:right;"> <a href="{{route('notes.create')}}" class="btn btn-dark btn-md"><i class="bi bi-plus"></i> Ajouter une note de service</a></div><br><br><br>
          @if (Session::has('success'))<br>
          <div class="alert alert-success mb-4" role="alert" class="text-white">
           <strong><button class="btn-close" type="button" data-bs-dismiss="alert"></button>
           {{ Session::get('success') }}</strong>
         </div>
         @endif
         <div class="table-responsive">
          <table class="table table-hover table-bordered" id="sampleTable">
            <thead>
              <tr>
                <th class="text-center">#</th>
                <th  class="text-center">sujet de la note</th>
                <th  class="text-center">Created</th>
                <th  class="text-center">actions</th>
              </tr>
            </thead>
            <tbody>
              @foreach($notes as $note)
              <tr class="text-center">
                <td>{{$note->id}}</td>
                <td>{{$note->subject}}</td>
                <td>{{$note->created_at}}</td>
                <td><a href="#" class="btn btn-danger btn-sm" href="{{route('notes.destroy', $note->id) }}" onclick="event.preventDefault(); document.getElementById('delete-form-{{ $note->id }}').submit();"data-bs-toggle="modal" data-bs-target="#staticBackdrop{{ $note->id }}"> <i class="bi bi-trash"></i></a>
                  <a href="#" class="btn btn-success btn-sm" href="{{route('notes.update', $note->id) }}" onclick="event.preventDefault(); document.getElementById('edit-form-{{ $note->id }}').submit();"data-bs-toggle="modal" data-bs-target="#staticBackdrope{{ $note->id }}"> <i class="bi bi-pencil"></i></a>

                  <a href="{{route('notes.edit', $note->id) }}" class="btn btn-primary btn-sm" target="_blank"> <i class="bi bi-printer"></i> imprimer la note</a></td>
                </tr>
                <!-- Modal -->
                <div class="modal fade" id="staticBackdrop{{ $note->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">Voulez vous supprimer cette note ??</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      <div class="modal-footer">
                        <form method="POST" action="{{route('notes.destroy', $note->id) }}">
                          @csrf
                          @method('DELETE')
                          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Non</button>
                          <button type="submit" class="btn btn-primary">Oui</button>
                        </form>
                      </div>
                    </div>
                  </div>
                </div>
                <!--Edit-Modal -->
                <div class="modal fade" id="staticBackdrope{{ $note->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel"><i class="bi bi-pencil"></i> Mettre a jour la note "{{$note->subject}}"</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      <form method="POST" action="{{route('notes.update', $note->id) }}">   
                        @csrf
                        @method('PUT')
                        <div class="modal-body">
                         <label>sujet de la note:*</label>
                         <input type="text" name="sujet" class="form-control" value="{{ $note->subject }}"><br>

                         <label>Contenu de la note:*</label>
                         <textarea class="form-control" id="myTextarea" name="contenu">
                           <?php echo $note->contenu ?>
                         </textarea>

                         <br>
                       </div>
                       <div class="modal-footer">
                         <button type="submit" class="btn btn-dark"><i class="bi bi-pencil"></i> Modifier Note</button>

                       </div>
                     </form>
                   </div>
                 </div>
               </div>
               @endforeach
             </tbody>
           </table>
         </div></div>
       </div>
     </div>
   </div>
 </main>
 @endsection