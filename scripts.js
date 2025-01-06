document.addEventListener("DOMContentLoaded", () => {
    const userTableBody = document.getElementById("userTableBody");
    const userForm = document.getElementById("userForm");
    const userModal = new bootstrap.Modal(document.getElementById("userModal"));

    const fetchUsers = async () => {
        const response = await fetch("utilisateur_back.php?action=fetch");
        const users = await response.json();
        userTableBody.innerHTML = users.map(user => `
            <tr>
                <td>${user.id}</td>
                <td>${user.nom}</td>
                <td>${user.prenom}</td>
                <td>${user.email}</td>
                <td>${user.motDePasse}</td>
                
                <td>
                    <button class="btn btn-warning btn-sm" onclick="editUser(${user.id}, '${user.nom}', '${user.prenom}, '${user.email}', '${user.motDePasse}')">Modifier</button>
                    <button class="btn btn-danger btn-sm" onclick="deleteUser(${user.id})">Supprimer</button>
                </td>
            </tr>
        `).join("");
    };

    window.editUser = (id, nom, prenom,email,motDePasse) => {
        document.getElementById("userId").value = id;
        document.getElementById("userName").value = nom;
        document.getElementById("userPrenom").value = prenom;
        document.getElementById("userEmail").value = email;
        document.getElementById("password").value = motDePasse;
        userModal.show();
    };

    window.deleteUser = async (id) => {
        if (confirm("Voulez-vous vraiment supprimer cet utilisateur ?")) {
            await fetch("utilisateur_back.php?action=delete", {
                method: "POST",
                body: new URLSearchParams({ id })
            });
            fetchUsers();
        }
    };

    userForm.addEventListener("submit", async (e) => {
        e.preventDefault();
        const formData = new FormData(userForm);
        const action = formData.get("id") ? "edit" : "add";

        await fetch(`utilisateur_back.php?action=${action}`, {
            method: "POST",
            body: formData
        });
        userModal.hide();
        userForm.reset();
        fetchUsers();
    });

    fetchUsers();
});
