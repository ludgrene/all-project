document.addEventListener('DOMContentLoaded', () => {
    const form = document.getElementById('food-form');
    const foodList = document.getElementById('food-list');

    let foodData = JSON.parse(localStorage.getItem('foodData')) || {};

    form.addEventListener('submit', (e) => {
        e.preventDefault();

        const name = document.getElementById('food-name').value;
        const calories = parseInt(document.getElementById('food-calories').value, 10);
        const date = document.getElementById('food-date').value;

        if (!foodData[date]) {
            foodData[date] = { items: [], totalCalories: 0 };
        }

        foodData[date].items.push({ name, calories });
        foodData[date].totalCalories += calories;

        updateFoodList();
        saveToLocalStorage();
        form.reset();
    });

    function updateFoodList() {
        foodList.innerHTML = '';

        for (const date in foodData) {
            const dateEntry = document.createElement('div');
            dateEntry.classList.add('date-entry');

            const dateTitle = document.createElement('h3');
            dateTitle.textContent = `${date} - Total Calories: ${foodData[date].totalCalories}`;
            dateEntry.appendChild(dateTitle);

            const itemList = document.createElement('ul');

            foodData[date].items.forEach((item, index) => {
                const li = document.createElement('li');
                li.textContent = `${item.name} - ${item.calories} calories`;

                const deleteBtn = document.createElement('button');
                deleteBtn.textContent = 'Supprimer';
                deleteBtn.addEventListener('click', () => {
                    foodData[date].totalCalories -= item.calories;
                    foodData[date].items.splice(index, 1);
                    if (foodData[date].items.length === 0) {
                        delete foodData[date];
                    }
                    updateFoodList();
                    saveToLocalStorage();
                });

                li.appendChild(deleteBtn);
                itemList.appendChild(li);
            });

            dateEntry.appendChild(itemList);
            foodList.appendChild(dateEntry);
        }
    }

    function saveToLocalStorage() {
        localStorage.setItem('foodData', JSON.stringify(foodData));
    }

    // Initial call to display stored data
    updateFoodList();

    // Animation Canvas
    const canvas = document.getElementById('animationCanvas');
    const ctx = canvas.getContext('2d');

    let x = canvas.width / 2;
    let y = canvas.height / 2;
    let dx = 2;
    let dy = 2;
    const ballRadius = 20; // Ballon agrandi

    // Zone de limitation
    const limitX1 = 50;
    const limitX2 = canvas.width - 50;
    const limitY1 = 50;
    const limitY2 = canvas.height - 50;

    // Score
    let bounceCount = 0;

    // Couleur du ballon
    let ballColor = '#0095DD';

    // Son de rebond
    const bounceSound = new Audio('path_to_bounce_sound.mp3');

    // Particules
    let particles = [];

    function getRandomColor() {
        const letters = '0123456789ABCDEF';
        let color = '#';
        for (let i = 0; i < 6; i++) {
            color += letters[Math.floor(Math.random() * 16)];
        }
        return color;
    }

    function createParticles(x, y) {
        for (let i = 0; i < 10; i++) {
            particles.push({
                x: x,
                y: y,
                dx: (Math.random() - 0.5) * 4,
                dy: (Math.random() - 0.5) * 4,
                life: 50
            });
        }
    }

    function drawParticles() {
        particles.forEach((particle, index) => {
            ctx.beginPath();
            ctx.arc(particle.x, particle.y, 3, 0, Math.PI * 2);
            ctx.fillStyle = 'rgba(0, 150, 255, 0.7)';
            ctx.fill();
            ctx.closePath();

            particle.x += particle.dx;
            particle.y += particle.dy;
            particle.life--;

            if (particle.life <= 0) {
                particles.splice(index, 1);
            }
        });
    }

    function drawBall() {
        ctx.beginPath();
        ctx.arc(x, y, ballRadius, 0, Math.PI * 2);
        ctx.fillStyle = ballColor;
        ctx.fill();
        ctx.closePath();
    }

    function drawLimits() {
        ctx.beginPath();
        ctx.rect(limitX1, limitY1, limitX2 - limitX1, limitY2 - limitY1);
        ctx.strokeStyle = 'red';
        ctx.stroke();
        ctx.closePath();
    }

    function drawScore() {
        ctx.font = '16px Arial';
        ctx.fillStyle = '#0095DD';
        ctx.fillText('Bounces: ' + bounceCount, 8, 20);
    }

    function drawTimer() {
        let elapsedTime = Math.floor((Date.now() - startTime) / 1000);
        ctx.font = '16px Arial';
        ctx.fillStyle = '#0095DD';
        ctx.fillText('Time: ' + elapsedTime + 's', 8, 40);
    }

    function draw() {
        ctx.clearRect(0, 0, canvas.width, canvas.height);
        drawLimits();
        drawBall();
        drawScore();
        drawTimer();
        drawParticles();

        if (x + dx > limitX2 - ballRadius || x + dx < limitX1 + ballRadius) {
            dx = -dx;
            bounceCount++;
            ballColor = getRandomColor(); // Change la couleur du ballon après chaque rebond
            bounceSound.play();
            createParticles(x, y);
        }
        if (y + dy > limitY2 - ballRadius || y + dy < limitY1 + ballRadius) {
            dy = -dy;
            bounceCount++;
            ballColor = getRandomColor(); // Change la couleur du ballon après chaque rebond
            bounceSound.play();
            createParticles(x, y);
        }

        x += dx;
        y += dy;
    }

    setInterval(draw, 10);

    // Chronomètre
    let startTime = Date.now();

    // Ajouter des écouteurs d'événements pour les touches du clavier
    document.addEventListener('keydown', (e) => {
        switch (e.code) {
            case 'ArrowUp':
                dy = -2;
                dx = 0;
                break;
            case 'ArrowDown':
                dy = 2;
                dx = 0;
                break;
            case 'ArrowLeft':
                dx = -2;
                dy = 0;
                break;
            case 'ArrowRight':
                dx = 2;
                dy = 0;
                break;
        }
    });
});
