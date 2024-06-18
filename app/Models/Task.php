<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

            //cette fonction est complementaire avec la laison du model implicite (Binding), coder dans le web.php (Route::get('/tasks/{task}/edit', function (Task $task))
            // cette methode detemine quelle attribut du modele dois être utiliser lors de la resolution des routes
            // par default, Laravel utilise la primary Key (generalement id)
            //cela nous permet donc de customiser notre URL
            //slug = version simplifiée d'un titre de taches ;)
    // public function getRouteKeyName(){
    //     return 'slug';
    // }
    
    //Definir explicitement quelles attribut PEUVENT etre assignés en masse (assignation des attribut du model en une seul operation)
    //cette propriété empeche donc l'assignation en masse de tout autres assignation non prevue
    //Ne jamais ajouter d'information sensible comme des mot de passe aux propriétés fillable
    protected $fillable = ['title', 'description', 'long_description'];
    //guarded est l'opposer de fillable, definis explicitement ce qui NE PEUT PAS etre assigné en masse
    //On utilise soit l'un soit l'autre mais pas les deux en meme temps
    //protected $guarded = ['secret'];

    
    //cette methode inverse la propriete completed de l'object (ici true et false)
    public function toggleComplete(){
        $this->completed = !$this->completed;
        $this->save();
    }
}
