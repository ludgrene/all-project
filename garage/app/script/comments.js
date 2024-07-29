document.addEventListener('DOMContentLoaded', () => {
    const container = document.getElementById('commentaires-container');

    // Définir les données des commentaires directement dans le script
    const commentairesData = [
        {
            nom: "Alice",
            commentaire: "Super produit!",
            note: 5
        },
        {
            nom: "Bob",
            commentaire: "Pas mal, mais peut être amélioré.",
            note: 3
        },
        {
            nom: "Charlie",
            commentaire: "Je ne suis pas satisfait.",
            note: 1
        }
    ];

    // Générer dynamiquement le HTML des commentaires
    commentairesData.forEach(commentaire => {
        let starHtml = '';
        for (let i = 0; i < 5; i++) {
            starHtml += i < commentaire.note ? '<span class="fa fa-star checked"></span>' : '<span class="fa fa-star"></span>';
        }

        const html = `
            <div class="card mb-3">
                <div class="card-body">
                    <h5 class="card-title">${commentaire.nom}</h5>
                    <p class="card-text">${commentaire.commentaire}</p>
                    <div class="rating">${starHtml}</div>
                </div>
            </div>
        `;
        container.innerHTML += html;
    });
});

// Ajout d'animations de survol pour les boutons
document.querySelectorAll('.btn').forEach(button => {
    button.addEventListener('mouseover', () => {
        button.style.transform = "scale(1.05)";
        button.style.transition = "transform 0.3s ease";
    });
    button.addEventListener('mouseout', () => {
        button.style.transform = "scale(1)";
    });
});

// Animation de fondu pour les images
document.querySelectorAll('img').forEach(img => {
    img.style.opacity = 0;
    img.onload = () => {
        img.style.transition = 'opacity 0.5s ease-in-out';
        img.style.opacity = 1;
    };
});
