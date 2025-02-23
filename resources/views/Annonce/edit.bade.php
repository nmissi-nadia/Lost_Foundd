<form action="{{ route('annonce.update', $annonce->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT') 
    
    <div>
        <label for="title">Titre</label>
        <input type="text" name="title" value="{{ $annonce->title }}" required>
    </div>
    
    <div>
        <label for="description">Description</label>
        <textarea name="description" required>{{ $annonce->description }}</textarea>
    </div>
    
    <div>
        <label for="location">Location</label>
        <input type="text" name="location" value="{{ $annonce->location }}" required>
    </div>
    
    <div>
        <label for="type">Type</label>
        <select name="type" required>
            <option value="lost" {{ $annonce->type === 'lost' ? 'selected' : '' }}>Objet Perdu</option>
            <option value="found" {{ $annonce->type === 'found' ? 'selected' : '' }}>Objet Trouvé</option>
        </select>
    </div>
    
    <div>
        <label for="image">Image (optional)</label>
        <input type="file" name="image">
    </div>
    
    <button type="submit">Mettre à jour l'annonce</button>
</form>