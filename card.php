<style>
    /* Your styles */

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
        background: #a78bfa;
        border-radius: 4px;
    }

    .post-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-top: 50px;
        line-height: 20px;
    }

    #sortSelect {
        background-color: darkred;
        border-radius: 20px;
        padding: 10px 28px;
        background-image: url("data:image/svg+xml;charset=US-ASCII,%3Csvg%20fill%3D'%23ffffff'%20height%3D'20'%20viewBox%3D'0%200%2024%2024'%20width%3D'20'%20xmlns%3D'http%3A//www.w3.org/2000/svg'%3E%3Cpath%20d%3D'M7%2010l5%205%205-5z'/%3E%3C/svg%3E");
        background-repeat: no-repeat;
        background-position: right 0.8rem center;
        background-size: 1rem;
        transition: all 0.3s ease;
        cursor: pointer;
        appearance: none;
    }

    .post-title {
        color: red;
        font-weight: bold;
        font-size: 30px;
    }

    @media (max-width: 1024px) {
        .game-card {
            flex: 0 0 calc((100% - 20px) / 2);
            max-width: 100%;
        }
        .post-title {
            font-size: 30px;
        }
    }

    @media (max-width: 480px) {
        .game-card {
            flex: 0 0 90vw;
            max-width: 90vw;
            background: none;
            border: none;
            box-shadow: none;
            margin-top: 15px;
        }
        #sortSelect {
            padding: 5px 27px;
        }
        .post-header, .post-subtitle {
            padding: 0 16px;
        }
        .post-title {
            font-size: 18px;
        }
        .post-subtitle {
            font-size: 13px;
        }
        #category {
            padding: 0 16px;
        }
    }

    .category-filter {
        display: flex;
        justify-content: flex-start;
        align-items: center;
        margin: 1rem 0;
    }

    .custom-select {
        background-color: #1f2937;
        color: #fff;
        padding: 0.6rem 2.5rem 0.6rem 1rem;
        font-size: 1rem;
        border: 1px solid #374151;
        border-radius: 0.5rem;
        appearance: none;
        cursor: pointer;
        background-image: url("data:image/svg+xml;charset=US-ASCII,%3Csvg%20fill%3D'%23ffffff'%20height%3D'20'%20viewBox%3D'0%200%2024%2024'%20width%3D'20'%20xmlns%3D'http%3A//www.w3.org/2000/svg'%3E%3Cpath%20d%3D'M7%2010l5%205%205-5z'/%3E%3C/svg%3E");
        background-repeat: no-repeat;
        background-position: right 0.8rem center;
        background-size: 1rem;
        transition: all 0.3s ease;
    }

    .custom-select:hover {
        color: red;
    }

    .custom-select:focus {
        outline: none;
        border-color: #3b82f6;
        box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.3);
    }

    .custom-select option {
        background-color: #1f2937;
        color: #fff;
        padding: 5px;
    }

    /* Arrow buttons styling */
    .arrow-btn {
        position: absolute;
        background-color: rgba(100, 100, 100, 0.7);
        border: none;
        color: white;
        font-size: 2rem;
        width: 40px;
        height: 60px;
        cursor: pointer;
        z-index: 10;
        border-radius: 6px;
        transition: background-color 0.3s ease, transform 0.15s ease;
        display: flex;
        align-items: center;
        justify-content: center;
        user-select: none;
        top: 50%;
        transform: translateY(-50%);
    }

    .arrow-btn.left-0 {
        left: 10px;
    }

    .arrow-btn.right-0 {
        right: 10px;
    }

    .arrow-btn:hover {
        background-color: rgba(255, 255, 255, 0.8);
        color: black;
    }

    .game-card {
        flex: 0 0 calc((100% - 40px) / 3);
        scroll-snap-align: start;
        min-width: 280px;
        max-width: 320px;
        cursor: pointer;
        background: #1f2937;
        border-radius: 10px;
        overflow: hidden;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.4);
        transition: all 0.3s ease;
        position: relative;
        border: 1px solid #374151;
        display: flex;
        flex-direction: column;
    }
</style>

<div class="post-container">
    <div class="post-header">
        <h1 class="post-title">Popular Cities in Bangladesh</h1>
        <!-- Sort dropdown -->
        <select id="sortSelect">
            <option value="asc" <?= isset($_GET['sort']) && $_GET['sort'] === 'asc' ? 'selected' : '' ?>>A–Z</option>
            <option value="desc" <?= isset($_GET['sort']) && $_GET['sort'] === 'desc' ? 'selected' : '' ?>>Z–A</option>
        </select>
    </div>

    <p class="post-subtitle mt-2">
        Discover the top popular cities in Bangladesh, ranked according to verified user reviews <br> and player ratings to guide you to the most loved locations.
    </p>
    <!-- Category Filter -->
    <div class="mt-4 mb-4" id="category">
        <form method="GET" class="category-filter">
            <select
                id="category"
                name="category"
                class="custom-select"
                onchange="this.form.submit()"
            >
                <option value="">All Categories</option>
                <?php foreach ($categories as $cat): ?>
                    <option value="<?php echo $cat['id']; ?>"
                        <?php echo ($selectedCategory == $cat['id']) ? 'selected' : ''; ?>>
                        <?php echo htmlspecialchars($cat['name']); ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </form>
    </div>

    <div class="relative">
        <!-- Left Arrow Button -->
        <button id="prev-btns" aria-label="Scroll Left" class="arrow-btn left-0">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none"
                 viewBox="0 0 24 24" stroke="currentColor" stroke-width="3">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/>
            </svg>
        </button>

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
                        <div class="game-image" style="height: 210px;">
                            <?php if (!empty($g['image'])): ?>
                                <img src="<?= './admin/page/game/' . htmlspecialchars($g['image']) ?>"
                                     alt="<?= htmlspecialchars($g['meta_text']) ?>"
                                     style="width:100%; height: 100%; object-fit: cover;">
                            <?php else: ?>
                                <div class="no-image-placeholder" style="height: 100%; display:flex; flex-direction:column; justify-content:center; align-items:center; color:#9ca3af;">
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
                </div>
            <?php endif; ?>
        </div>

        <!-- Right Arrow Button -->
        <button id="next-btns" aria-label="Scroll Right" class="arrow-btn right-0">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none"
                 viewBox="0 0 24 24" stroke="currentColor" stroke-width="3">
                <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/>
            </svg>
        </button>
    </div>
</div>

<script>
    // Sort dropdown
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

    // Drag to scroll & arrow button scroll
    $(function () {
  const $grid = $(".post-grid");
  const scrollAmount = 390;

  // Clone content before and after for infinite loop illusion
  const originalContent = $grid.html();
  $grid.prepend(originalContent);
  $grid.append(originalContent);

  // Scroll to the original items in the middle
  const originalScrollLeft = $grid[0].scrollWidth / 3;
  $grid.scrollLeft(originalScrollLeft);

  // Handle scroll event to loop scroll position
  $grid.on("scroll", function () {
    const maxScrollLeft = $grid[0].scrollWidth;
    const scrollLeft = $grid.scrollLeft();

    if (scrollLeft <= 0) {
      // Scrolled to (or past) left cloned content - jump to middle copy
      $grid.scrollLeft(scrollLeft + (maxScrollLeft / 3));
    } else if (scrollLeft >= (maxScrollLeft * 2) / 3) {
      // Scrolled to (or past) right cloned content - jump back to middle copy
      $grid.scrollLeft(scrollLeft - (maxScrollLeft / 3));
    }
  });

  // Arrow buttons scroll with looping
  $("#prev-btns").on("click", function () {
    $grid.animate(
      { scrollLeft: $grid.scrollLeft() - scrollAmount },
      300
    );
  });

  $("#next-btns").on("click", function () {
    $grid.animate(
      { scrollLeft: $grid.scrollLeft() + scrollAmount },
      300
    );
  });

  // Mouse wheel scroll horizontally
});

</script>
