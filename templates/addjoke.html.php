<form action="" method="post" enctype="multipart/form-data">
    <label for="joketext">Joke Text:</label>
    <textarea name="joketext" rows="3" cols="40"></textarea>

    <label for="jokeimg">Choose an image for your joke:</label>
    <select id="jokeimg" name="jokeimg">
        <option value="default.png">Standard Default Image</option>
        <option value="joke1.png">Joke Image 1 (PNG)</option>
        <option value="joke2.jpg">Joke Image 2 (JPG)</option>
        <option value="joke3.png">Joke Image 3 (PNG)</option>
    </select>

    <label for="authorid">Author ID:</label>
    <input type="number" id="authorid" name="authorid" required>

    <input type="submit" name="submit" value="Add">
</form>