<style>
    /* Keep your existing styles except for post-grid */
    
    /* Remove previous .post-grid grid styles */
    .post-grid {
        display: flex;
        overflow-x: auto;
        gap: 20px;
        padding-bottom: 12px;
        scroll-snap-type: x mandatory;
        -webkit-overflow-scrolling: touch;
    }

    .post-grid::-webkit-scrollbar {
        height: 8px;
    }

    .post-grid::-webkit-scrollbar-thumb {
        background: #a78bfa; /* purple */
        border-radius: 4px;
    }
.post-header{
    display: flex;
    justify-content: space-between;
}
#sortSelect {
    background-color:darkred;
    border-radius: 20px;
    padding: 2px 15px;
}
    .game-card {
        flex: 0 0 calc((100% - 40px) / 3); /* 3 cards visible minus gaps */
        scroll-snap-align: start;
        min-width: 280px; /* prevent cards from shrinking too small */
        max-width: 320px;
        cursor: pointer;
        background: #1f2937;
        border-radius: 10px;
        overflow: hidden;
        box-shadow: 0 4px 12px rgba(0,0,0,0.4);
        transition: all 0.3s ease;
        position: relative;
        border: 1px solid #374151;
        display: flex;
        flex-direction: column;
    }
    .post-title{
         color: red;
         font-weight: bold;
         font-size: 30px;
    }

    @media (max-width: 1024px) {
        .game-card {
            flex: 0 0 calc((100% - 20px) / 2); /* 2 cards on medium */
            max-width: 100%;
        }
              .post-title{
            font-size: 30px;
         
        }
    }

    @media (max-width: 480px) {
        .game-card {
            flex: 0 0 90vw; /* almost full width on mobile */
            max-width: 90vw;
            background: none;
            border: none;
            box-shadow: none;
            margin-top: 15px;

        }
        .post-header, .post-subtitle{
            padding: 0 16px;
        }
        .post-title{
         font-size: 16px;
        
        }
        .post-subtitle{
font-size: 13px;
        }
    }
</style>


<div class="post-container">
    <div class="post-header">
        <h1 class="post-title">Popular Cities in Bangladesh</h1>
        <!-- Sort dropdown -->
        <select id="sortSelect">
            <option value="">Sort </option>
            <option value="asc" <?= isset($_GET['sort']) && $_GET['sort'] === 'asc' ? 'selected' : '' ?>>A–Z</option>
            <option value="desc" <?= isset($_GET['sort']) && $_GET['sort'] === 'desc' ? 'selected' : '' ?>>Z–A</option>
        </select>
    </div>

    <p class="post-subtitle">
    Discover the top popular cities in Bangladesh, ranked according to verified user reviews <br> and player ratings to guide you to the most loved locations.
    </p>
  <P class="text-scroll">
    See Mores Scroll Left/Right 
  </P>

    <div class="post-grid">
        <?php
        if (isset($_GET['sort']) && in_array($_GET['sort'], ['asc', 'desc'])) {
            usort($games, function ($a, $b) {
                $order = $_GET['sort'] === 'asc' ? 1 : -1;
                return $order * strcmp($a['name'], $b['name']);
            });
        }
        ?>

        <?php if (!empty($games)): ?>
            <?php foreach ($games as $index => $g): ?>
                <div class="game-card" onclick="window.location.href='detail?id=<?= $g['id'] ?>'">
                    <div class="game-image" style="height: 210px; overflow: hidden;">
                        <?php if (!empty($g['image'])): ?>
                            <img src="<?= './admin/page/game/' . htmlspecialchars($g['image']) ?>"
                                 alt="<?= htmlspecialchars($g['meta_text']) ?>" style="width:100%; height: 100%; object-fit: cover;">
                        <?php else: ?>
                            <div class="no-image-placeholder" style="height: 100%;">
                                <svg width="48" height="48" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                </svg>
                                <span>No Image</span>
                            </div>
                        <?php endif; ?>
                    </div>
                    <div class="game-content" style="padding: 12px;">
                        <div class="game-rank" style="font-weight: bold; font-size: 18px; color:#f9fafb; margin-bottom: 6px;">
                            <?= ($index + 1) ?>. <?= htmlspecialchars($g['name']) ?>
                        </div>
                        <div class="game-category" style="color: #9ca3af; margin-bottom: 8px;">
                            <?= isset($g['category_name']) ? htmlspecialchars($g['category_name']) : '' ?>
                        </div>
                        <div class="game-description" style="font-size: 14px; color: #e5e7eb;">
                            <?= htmlspecialchars(mb_strimwidth($g['description'], 0, 120, '...')) ?>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <div class="empty-state" style="text-align:center; padding:80px 20px; color:#6b7280; grid-column: 1 / -1;">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" style="width:64px; height:64px; margin-bottom:16px; color:#4b5563;">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414a1 1 0 00-.707-.293H4"/>
                </svg>
                <h3 style="font-size: 20px; font-weight: 600; margin-bottom: 8px;">No Posts Found</h3>
                <p>No content found in this category. Try selecting a different category.</p>
            </div>
        <?php endif; ?>
    </div>
</div>

<script>
    // Sort dropdown code stays the same
    document.getElementById('sortSelect').addEventListener('change', function () {
        const selected = this.value;
        const url = new URL(window.location.href);
        if (selected) {
            url.searchParams.set('sort', selected);
        } else {
            url.searchParams.delete('sort');
        }
        window.location.href = url.toString();
    });

    // Drag to scroll horizontally on the post-grid container
    const slider = document.querySelector('.post-grid');
    let isDown = false;
    let startX;
    let scrollLeft;

    slider.addEventListener('mousedown', (e) => {
        isDown = true;
        slider.classList.add('active');
        startX = e.pageX - slider.offsetLeft;
        scrollLeft = slider.scrollLeft;
    });
    slider.addEventListener('mouseleave', () => {
        isDown = false;
        slider.classList.remove('active');
    });
    slider.addEventListener('mouseup', () => {
        isDown = false;
        slider.classList.remove('active');
    });
    slider.addEventListener('mousemove', (e) => {
        if (!isDown) return;
        e.preventDefault();
        const x = e.pageX - slider.offsetLeft;
        const walk = (x - startX) * 2; //scroll speed
        slider.scrollLeft = scrollLeft - walk;
    });
</script>
