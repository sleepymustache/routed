{{ #include components/header }}
    <form action="/todo/add" method="post">
        <legend>Add Item</legend>
        <ul>
            <li><input type="text" name="item" id="item" placeholder="Add a new todo item"></li>
            <li><input type="submit" value="Add" /></li>
        </ul>
    </form>
{{ #include components/footer }}