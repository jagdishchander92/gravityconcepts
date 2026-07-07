function drawConnectors() {
    const svg = document.getElementById("connector-svg");
    const grid = svg.parentElement;
    const wraps = Array.from(grid.querySelectorAll(".process-card__icon-wrap"));
    svg.innerHTML = "";

    const gridRect = grid.getBoundingClientRect();
    const cols = Math.round(
        grid.offsetWidth / (wraps[0]?.offsetWidth + 28 || 268),
    );

    // Group cards into rows based on their top position
    const rows = [];
    let currentRow = [];
    let lastTop = null;
    wraps.forEach((w, i) => {
        const card = w.closest(".process-card");
        const cardRect = card.getBoundingClientRect();
        const top = Math.round(cardRect.top);
        if (lastTop !== null && Math.abs(top - lastTop) > 10) {
            rows.push(currentRow);
            currentRow = [];
        }
        currentRow.push(w);
        lastTop = top;
    });
    if (currentRow.length) rows.push(currentRow);

    // Only draw on desktop (2+ columns)
    if (cols < 2) return;

    rows.forEach((row) => {
        if (row.length < 2) return;
        const centers = row.map((w) => {
            const r = w.getBoundingClientRect();
            return {
                x: r.left - gridRect.left + r.width / 2,
                y: r.top - gridRect.top + r.height / 2,
            };
        });

        for (let i = 0; i < centers.length - 1; i++) {
            const a = centers[i];
            const b = centers[i + 1];
            const iconR = row[i].offsetWidth / 2 + 6; // icon radius + dashed ring gap

            // Draw dashed line between icon edges
            const line = document.createElementNS(
                "http://www.w3.org/2000/svg",
                "line",
            );
            line.setAttribute("x1", a.x + iconR);
            line.setAttribute("y1", a.y);
            line.setAttribute("x2", b.x - iconR);
            line.setAttribute("y2", b.y);
            line.setAttribute("stroke", "#FF6D45");
            line.setAttribute("stroke-width", "2");
            line.setAttribute("stroke-dasharray", "6 6");
            line.setAttribute("stroke-linecap", "round");
            line.setAttribute("opacity", "0.45");
            svg.appendChild(line);

            // Arrow head at end
            const angle = Math.atan2(b.y - a.y, b.x - a.x);
            const ax = b.x - iconR;
            const ay = b.y;
            const aSize = 6;
            const p1x = ax - aSize * Math.cos(angle - Math.PI / 7);
            const p1y = ay - aSize * Math.sin(angle - Math.PI / 7);
            const p2x = ax - aSize * Math.cos(angle + Math.PI / 7);
            const p2y = ay - aSize * Math.sin(angle + Math.PI / 7);
            const arrow = document.createElementNS(
                "http://www.w3.org/2000/svg",
                "polyline",
            );
            arrow.setAttribute(
                "points",
                `${p1x},${p1y} ${ax},${ay} ${p2x},${p2y}`,
            );
            arrow.setAttribute("stroke", "#FF6D45");
            arrow.setAttribute("stroke-width", "2");
            arrow.setAttribute("stroke-linecap", "round");
            arrow.setAttribute("stroke-linejoin", "round");
            arrow.setAttribute("fill", "none");
            arrow.setAttribute("opacity", "0.7");
            svg.appendChild(arrow);
        }
    });
}

// Run on load and resize
// window.addEventListener("load", drawConnectors);
// window.addEventListener("resize", drawConnectors);
// Also run after fonts/images settle
// setTimeout(drawConnectors, 300);
