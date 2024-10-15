# CRUD et son implémentation dans League of Branly

## Introduction au CRUD

CRUD est un acronyme qui signifie Create, Read, Update, Delete (Créer, Lire, Mettre à jour, Supprimer). Ces quatre opérations fondamentales sont à la base de la plupart des systèmes de gestion de données et d'applications web.

1. **Create (Créer)** : Ajouter de nouvelles données
2. **Read (Lire)** : Récupérer et afficher des données existantes
3. **Update (Mettre à jour)** : Modifier des données existantes
4. **Delete (Supprimer)** : Effacer des données existantes

Dans le contexte d'une application web comme League of Branly, ces opérations sont généralement implémentées via des routes HTTP et des méthodes de contrôleur correspondantes.

## Implémentation du CRUD dans League of Branly

Prenons l'exemple de la gestion des champions dans League of Branly pour illustrer l'implémentation du CRUD.

### 1. Create (Créer)

La création d'un champion est séparée dans deux fonctions distinctes.
- La route GET `champions/create` va afficher le formulaire permettant la création d'un champion
- La route POST `champions` qui va vérifier les informations récupérées par le formulaire et les persister dans la base de données

#### Méthode du contrôleur :
```php
    /**
     * Show the form for creating a new champion.
     */
    public function create()
    {
        $genders = Gender::all();
        $positions = Position::all();
        $species = Specie::all();
        $resources = Resource::all();
        $ranges = Range::all();
        $regions = Region::all();
        $years = Year::orderBy('year', 'desc')->get(); // Ajoutez cette ligne

        return view('champions.create', compact('genders', 'positions', 'species', 'resources', 'ranges', 'regions', 'years'));
    }

    /**
     * Store a newly created champion in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'years_id' => 'required|exists:years,years_id',
            'gender_id' => 'required|exists:genders,id',
            'resource_id' => 'required|exists:resources,id',
            'species' => 'required|array',
            'species.*' => 'exists:species,id',
            'range_type' => 'required|array',
            'range_type.*' => 'exists:range_type,id',
            'positions' => 'required|array',
            'positions.*' => 'exists:positions,id',
            'regions' => 'required|array',
            'regions.*' => 'exists:regions,id',
        ]);

        // Convert the release year to a date
        $validatedData['year_id'] = Carbon::createFromDate($validatedData['release_year'], 1, 1)->toDateString();
        unset($validatedData['release_year']);

        $champion = Champion::create($validatedData);

        $champion->positions()->attach($request->positions);
        $champion->regions()->attach($request->regions);
        $champion->rangeTypes()->attach($request->ranges);
        $champion->species()->attach($request->species);

        return redirect()->route('champions.index')->with('success', 'Champion created successfully!');
    }
```

### 2. Read (Lire)

On distingue deux lectures différentes :
- La route GET `champions` va afficher l'ensemble des champions
- La route GET `champions/{champion_id}` va afficher le champion dont la clé primaire est `champion_id`

#### Méthodes du contrôleur :
```php
public function index()
{
    $champions = Champion::all();
    return view('champions.index', compact('champions'));
}

public function show(Champion $champion)
{
    return view('champions.show', compact('champion'));
}
```

### 3. Update (Mettre à jour)

#### Routes :
```php
Route::get('/champions/{champion}/edit', [ChampionController::class, 'edit'])->name('champions.edit');
Route::put('/champions/{champion}', [ChampionController::class, 'update'])->name('champions.update');
```

#### Méthodes du contrôleur :
```php
public function edit(Champion $champion)
{
    return view('champions.edit', compact('champion'));
}

public function update(Request $request, Champion $champion)
{
    $validatedData = $request->validate([
        'name' => 'required|max:50',
        'title' => 'required|max:100',
        // Autres validations...
    ]);

    $champion->update($validatedData);

    return redirect()->route('champions.index')
        ->with('success', 'Champion mis à jour avec succès.');
}
```

### 4. Delete (Supprimer)

#### Route :
```php
Route::delete('/champions/{champion}', [ChampionController::class, 'destroy'])->name('champions.destroy');
```

#### Méthode du contrôleur :
```php
public function destroy(Champion $champion)
{
    $champion->delete();

    return redirect()->route('champions.index')
        ->with('success', 'Champion supprimé avec succès.');
}
```

## Implémentation dans les vues

Les vues correspondantes (index, show, create, edit) utilisent des formulaires et des liens pour interagir avec ces routes et méthodes du contrôleur.

### Exemple de formulaire de création (create.blade.php) :

```html
<form action="{{ route('champions.store') }}" method="POST">
    @csrf
    <div class="form-group">
        <label for="name">Nom</label>
        <input type="text" class="form-control" id="name" name="name" required>
    </div>
    <div class="form-group">
        <label for="title">Titre</label>
        <input type="text" class="form-control" id="title" name="title" required>
    </div>
    <!-- Autres champs du formulaire -->
    <button type="submit" class="btn btn-primary">Créer le champion</button>
</form>
```

### Exemple de liste avec options de mise à jour et de suppression (index.blade.php) :

```html
@foreach($champions as $champion)
    <tr>
        <td>{{ $champion->name }}</td>
        <td>{{ $champion->title }}</td>
        <td>
            <a href="{{ route('champions.edit', $champion) }}" class="btn btn-sm btn-primary">Modifier</a>
            <form action="{{ route('champions.destroy', $champion) }}" method="POST" style="display: inline-block;">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce champion ?')">Supprimer</button>
            </form>
        </td>
    </tr>
@endforeach
```
