document.getElementById('add-list-item').addEventListener('click', function() {
    const listContainer = document.getElementById('list-container');
    const newListItem = document.createElement('div');
    newListItem.innerHTML = `
        <input type="checkbox" name="list_items[]" value="item" />
        <input type="text" name="list_items[]" placeholder="List item" />
    `;
    listContainer.appendChild(newListItem);
});
