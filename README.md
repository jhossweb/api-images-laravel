# Api Laravel Images

<p>
    Esta es una api que usa laravel sancutm para validar el inicio de sesión con tokens. Para el guardado de las imágenes se usa relaciones 1:N entre usuarios e imágenes y N:M entre etiquetas e imágenes.
</p>

## Insertar Etiquetas
<p>
    Hago enfácis en este método ya que es poco usual ya que no se usa los método CRUD básicos.
</p>
<p>
    Las etiquetas deben ser únicas, pero muchas imágenes puede tener varias etiquetas y varias etiquetas pueden tener varias imágenes. Por cada insersión las etiqutas pueden estar ya creadas y para evitar la redundancia, se usa el siguiente método:
</p>

```
firstOrCreate
```

### Usando firstOrCreate

```
$tag_name = json_decode($tags, true);

$tag = Tag::firstOrCreate(["tag_name" => $tagName]);
$imgSaved->tags()->attach($tag->id);
```

<p>
    Lo que hace es verificar si las etiquetas existen, de existir, solo las asigna la imágen y de no existir, las guarda en la tabla **tags** y con el attach las asigna la imágen que se está guardando. 
</p>