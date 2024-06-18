<?php

use App\Http\Requests\TaskRequest;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use \App\Models\Task;

/* #region Classe Task et tableau de tache, ancienne methode avant mise en place de la DB */
// class Task
// {
//     public function __construct(
//         public int $id,
//         public string $title,
//         public string $description,
//         public ?string $long_description,//?=optionnel
//         public bool $completed,
//         public string $created_at,
//         public string $updated_at
//     ) {
//     }
// }

// $tasks = [
//     new Task(
//         1,
//         'Buy groceries',
//         'Task 1 description',
//         'Task 1 long description',
//         false,
//         '2023-03-01 12:00:00',
//         '2023-03-01 12:00:00'
//     ),
//     new Task(
//         2,
//         'Sell old stuff',
//         'Task 2 description',
//         null,
//         false,
//         '2023-03-02 12:00:00',
//         '2023-03-02 12:00:00'
//     ),
//     new Task(
//         3,
//         'Learn programming',
//         'Task 3 description',
//         'Task 3 long description',
//         true,
//         '2023-03-03 12:00:00',
//         '2023-03-03 12:00:00'
//     ),
//     new Task(
//         4,
//         'Take dogs for a walk',
//         'Task 4 description',
//         null,
//         false,
//         '2023-03-04 12:00:00',
//         '2023-03-04 12:00:00'
//     ),
// ];
/* #endregion */
//Si l'on est encore a la racine du dossier, il me redirive vers la route /tasks
Route::get('/', function () {
    return redirect()->route('tasks.index');
});
Route::view('/tasks/create', 'create')
    ->name('tasks.create');//l'ordre des route a son imporance: Tjs mettre les route specifique avant les routes dynamique
/* #region  Route::get('/tasks', function ()*/
//v1
// Route::get('/tasks', function () use ($tasks){
//     return view('index', [
//         'toto'=> $tasks
//     ]);
// })->name('Tasks.index');

//v2
// Route::get('/tasks', function () {
//     return view('index', [
//         'totosss'=> \App\Models\Task::all()
//     ]);
// })->name('Tasks.index');
//v4
// Route::get('/tasks', function () {
//     return view('index', [
//         'totosss'=> \App\Models\Task::latest()->where('completed', true)->get()//ne montre que les tache terminée
//     ]);
// })->name('Tasks.index');
/* #endregion */
//v3
Route::get('/tasks', function () {
    return view('index', [
        // 'totosss' => Task::latest()->get()//trie les enregistrement par date de creation, get() lesrecupere dans une collection d'objet
        //j'ai importe un use statement pour ne pas devoir ecrire le chemin complet du modele
        'totosss' => Task::latest()->paginate(5)//meme commande mais afficher les resultats sur plusieurs page (si beaucoup de resultats)
        //le (5) indique le nombre d'elements qui sera afficher sur chaque page (5 taches)
    ]);
})->name('tasks.index');

/* #region  */
//v1
// Route::get('/tasks/{id}/edit', function ($id) {
//     return view('edit', [
//         'task' => Task::findOrFail($id)//findOrFail redirige vers la page 404 en cas d'erreur
//     ]);
// })->name('tasks.edit');
/* #endregion */
//v2
//On injecte directement une instance de la classe Task (biding)
Route::get('/tasks/{task}/edit', function (Task $task) {
    return view('edit', [
        'task' => $task
    ]);
})->name('tasks.edit');

/* #region Toute les routes utilisée avant la mise en place de la DB */
//v1
// Route::get('/tasks/{id}', function(){
//     return 'One single task';
// })->name('Tasks.show');

//v2
// Route::get('/tasks/{ce_qui_est_ici}', function($est_passé_ici_en_parametre){
//     return 'One single task';
// })->name('Tasks.show');


//v3
// Route::get('/tasks/{id}', function($id) use($tasks){
//     $task = collect($tasks)->firstWhere('id', $id);
//     if(!$task){
//         abort(Response::HTTP_NOT_FOUND);
//     }
//     return view('show', ['task'=>$task]);
// })->name('Tasks.show');

//v4
// Route::get('/tasks/{id}', function($id){
//     return view('show', [
//         'task'=>\App\Models\Task::find($id)//Utilise la méthode statique find pour récupérer un enregistrement de la base de données par son id
//     ]);
// })->name('Tasks.show');
//v5
// Route::get('/tasks/{id}', function ($id) {
    //     return view('show', [
        //         'task' => Task::findOrFail($id)//findOrFail redirige vers la page 404 en cas d'erreur
        //     ]);
        // })->name('tasks.show');
        
        /* #endregion */
//v6
Route::get('/tasks/{task}', function (Task $task) {
    return view('show', [
        'task' => $task
    ]);
})->name('tasks.show');
/* #region  */
//v1
// Route::post('/tasks', function(){
//     dd('Nous avons atteind la route de stockage');//dump and die pour debogage
// })->name('tasks.store'); 

//v2
// La route /tasks atteinte via une requete post n'est pas la meme route que celle atteinte par le requete get
// En HTTP, les méthodes de requetes get, post, put, delete, etc... permettent de définir des comportement differents pour une meme URL
// la methode Request, contient toutes les information sur la requete envoyée (les données, les en-tête, les cookies, etc...)
// Route::post('/tasks', function (Request $request) {
//     dd($request->all());//dump and die pour debogage, va juste afficher toutes les informations contenue dans la requete
// })->name('tasks.store');
//v3
// Route::post('/tasks', function (Request $request) {
    //     //La requete validate fait partie du nettoyage des entrée utilisateur
    //     $data = $request->validate([
        //         'title'=>'required|max:255',
        //         'description'=>'required',
        //         'long_description'=>'required'
        //         ]);
        //     //$task=new \App\Models\Task;
        //     $task=new Task;
        //     $task->title = $data['title'];
        //     $task->description = $data['description'];
        //     $task->long_description = $data['long_description'];
        
        //     $task->save();
        
        //     return redirect()->route('tasks.show', ['id' => $task->id])
        //     //Message flash (il est stocké dans la session utilisateur jusqu'a ce qu'il soit affiché, apres il est supprimer pour evité qu'on puisse l'fficher plusieur fois), se place apres la redirection de route
        //     ->with('success', 'Tache cree avec succes');//le message flash s'appel success et il affiche le message "Tache cree avec succes"
        
        // })->name('tasks.store');

//v4
// Route::post('/tasks', function (TaskRequest $request) {
//     $data = $request->validated();//Permet d'obtenir les donnée validée dans TaskRequest/ rien ne s'execute ensuite si les donnée ne passe pas la validation
//     $task=new Task;
//     $task->title = $data['title'];
//     $task->description = $data['description'];
//     $task->long_description = $data['long_description'];
    
//     $task->save();
    
//     return redirect()->route('tasks.show', ['id' => $task->id])
//     ->with('success', 'Tache cree avec succes');

// })->name('tasks.store');
/* #endregion */
//v5
Route::post('/tasks', function (TaskRequest $request) {  
    //Methode create statique, la methode est directement appliquée sur la classe et non sur chaque instances comme dans les version precedente
    $task = Task::create($request->validated());//CRUD
    
    return redirect()->route('tasks.show', ['task' => $task->id])
    ->with('success', 'Tache cree avec succes');

})->name('tasks.store');


/* #region  */
//v1
// Route::put('/tasks/{id}', function ($id, Request $request) {
//     //La requete validate fait partie du nettoyage des entrée utilisateur
//     $data = $request->validate([
//         'title'=>'required|max:255',
//         'description'=>'required',
//         'long_description'=>'required'
//         ]);
//     //On cherche une tâche existante
//     $task=Task::findOrFail($id);
//     $task->title = $data['title'];
//     $task->description = $data['description'];
//     $task->long_description = $data['long_description'];
    
//     $task->save();
    
//     return redirect()->route('tasks.show', ['id' => $task->id])    
//     ->with('success', 'Tache modifiee avec succes');

// })->name('tasks.update');

//v2
// Route::put('/tasks/{task}', function (Task $task, Request $request) {
    //     //La requete validate fait partie du nettoyage des entrée utilisateur
    //     $data = $request->validate([
        //         'title'=>'required|max:255',
        //         'description'=>'required',
        //         'long_description'=>'required'
        //         ]);
        
        //     $task->title = $data['title'];
        //     $task->description = $data['description'];
        //     $task->long_description = $data['long_description'];
        
        //     $task->save();
        
        //     return redirect()->route('tasks.show', ['id' => $task->id])    
        //     ->with('success', 'Tache modifiee avec succes');
        
        // })->name('tasks.update');

//v3
// Route::put('/tasks/{task}', function (Task $task, TaskRequest $request) {
//     $data = $request->validated();//Permet d'obtenir les donnée validée dans TaskRequest/ rien ne s'execute ensuite si les donnée ne passe pas la validation
//     $task->title = $data['title'];
//     $task->description = $data['description'];
//     $task->long_description = $data['long_description'];
    
//     $task->save();
    
//     return redirect()->route('tasks.show', ['id' => $task->id])    
//     ->with('success', 'Tache modifiee avec succes');

// })->name('tasks.update');
/* #endregion */
//v4
Route::put('/tasks/{task}', function (Task $task, TaskRequest $request) { 
    // update = methode qui met a jour les attribut d'une instance du model (CRUD)   
    $task->update($request->validated());
    
    return redirect()->route('tasks.show', ['task' => $task->id])    
    ->with('success', 'Tache modifiee avec succes');

})->name('tasks.update');

Route::delete('/tasks/{task}', function(Task $task) {
    $task->delete();//CRUD

    return redirect()->route('tasks.index')
        ->with('success', 'La tache a été supprimée avec succes');
})->name('tasks.destroy');


Route::put('tasks/{task}/toggle-complete', function(Task $task){
    $task->toggleComplete();
    return redirect()->back()->with('success', 'Task update successfully :)');//la methode back redirige  l'utilisateur vers la page precedente
})->name('task.toggle-complete');


/* #region Test du début */
// Route::get('/hello', function () {
//     return 'Hello';
// })-> name('hello');


// Route::get('/greet/{name}', function ($name) {
//     return 'Hello ' . $name . '!';
// });


// Route::get('/hallo', function(){
//     return redirect()->route('hello');
// });
/* #endregion */
//Route renvoiée en cas d'erreur
Route::fallback(function () {
    return 'je me suis perdu :(';
});
