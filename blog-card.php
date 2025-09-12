<?php
include './admin/page/library/game_lib.php';
$gameObj = new Games();
$lang = isset($_GET['lang']) && in_array($_GET['lang'], ['en', 'bn']) ? $_GET['lang'] : 'bn';
$games = $gameObj->getgames($lang);
?>
    <style>
        /* Your original styles */
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

        #hotspot p {

            background-color: #992717;

        }

        .post-title {

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

            .post-header,
            .post-subtitle {
                padding: 0 16px;
            }

            .post-title {
                font-size: 18px;
            }

            .post-subtitle {
                font-size: 13px;
            }

            #hotspot {
                padding: 0 16px;
            }

        }

        /* Arrow buttons styling */
        .arrow-btn {
            position: absolute;
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
            left: 8px;
        }

        .arrow-btn.right-0 {
            right: 8px;
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

        /* Language selector styling */
        .lang-select {
            background-color: #1f2937;
            color: white;
            border-radius: 20px;
            padding: 10px 28px;
            background-image: url("data:image/svg+xml;charset=US-ASCII,%3Csvg%20fill%3D'%23ffffff'%20height%3D'20'%20viewBox%3D'0%200%2024%2024'%20width%3D'20'%20xmlns%3D'http%3A//www.w3.org/2000/svg'%3E%3Cpath%20d%3D'M7%2010l5%205%205-5z'/%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: right 0.8rem center;
            background-size: 1rem;
            transition: all 0.3s ease;
            cursor: pointer;
            appearance: none;
            margin-left: 10px;
        }
    </style>

    <div class="post-container">
        <div class="post-header">
            <h1 class="post-title text-gray-100 mb-4">
                <?php echo $lang === 'en'
                    ? 'Milktea & Bus Services in Chittagong'
                    : 'চট্টগ্রামে মিল্কটি ও বাস সার্ভিস'; ?>
            </h1>
        </div>

        <p class="post-subtitle mt-2">
            <?php
            echo $lang === 'en'
                ? 'Enjoy fresh Milktea with a variety of flavors and reliable bus services across Chittagong. Experience high-quality drinks, safe and comfortable travel, and excellent customer support with FancyWheel today.'
                : 'চট্টগ্রামে বিভিন্ন স্বাদের তাজা মিল্কটি এবং নির্ভরযোগ্য বাস সার্ভিস উপভোগ করুন। উচ্চমানের পানীয়, নিরাপদ ও আরামদায়ক যাত্রা এবং চমৎকার গ্রাহক সাপোর্ট উপভোগ করুন ফ্যান্সিওয়েলের সাথে।';
            ?>
        </p>


        <div class="mt-4 mb-4" id="hotspot">
            <p class="p-2 rounded-md w-[77px]  bg-gradient-to-r from-blue-600 to-purple-600">
                <?php echo $lang === 'en' ? 'Hotspot' : 'হটস্পট'; ?>
            </p>
        </div>

        <div class="relative">
            <!-- Left Arrow Button -->
            <button id="prev-btns" aria-label="Scroll Left" class="arrow-btn left-0">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none"
                    viewBox="0 0 24 24" stroke="currentColor" stroke-width="3">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
                </svg>
            </button>

            <div class="post-grid">
                <?php if (!empty($games)): ?>
                    <?php foreach ($games as $index => $g): ?>
                        <?php

                        $gameId = (int)$g['id'];
                        $slug = htmlspecialchars($g['slug']);
                        $gameName   = htmlspecialchars($g['name'], ENT_QUOTES, 'UTF-8');

                        $metaText   = htmlspecialchars($g['meta_text'] ?? '', ENT_QUOTES, 'UTF-8');

                        $plainText  = strip_tags($g['description']);
                        $trimmed    = htmlspecialchars(mb_strimwidth($plainText, 0, 120, '...'), ENT_QUOTES, 'UTF-8');
                        $gameImage  = !empty($g['image']) ? htmlspecialchars($g['image'], ENT_QUOTES, 'UTF-8') : '';
                        ?>

                        <div class="game-card" onclick="window.location.href='detail?slug=<?= $slug ?>&lang=<?= $lang ?>'">
                            <div class="game-image" style="height: 210px;">
                                <?php if (!empty($gameImage)): ?>
                                    <div class="relative w-full h-full overflow-hidden bg-gray-500">
                                        <!-- Spinner Overlay -->
                                        <div class="absolute inset-0 flex items-center justify-center bg-gray-500 z-10" id="spinner">
                                            <svg class="animate-spin h-8 w-8 text-white" xmlns="http://www.w3.org/2000/svg" fill="none"
                                                viewBox="0 0 24 24">
                                                <circle class="opacity-25" cx="12" cy="12" r="10"
                                                    stroke="currentColor" stroke-width="4"></circle>
                                                <path class="opacity-75" fill="currentColor"
                                                    d="M4 12a8 8 0 018-8v4a4 4 0 00-4 4H4z"></path>
                                            </svg>
                                        </div>

                                        <!-- Lazy Image -->
                                        <img src="<?= './admin/page/game/' . $gameImage ?>"
                                            loading="lazy"
                                            alt="<?= $metaText ?>"
                                            class="w-full h-full opacity-0 transition-opacity duration-500"
                                            onload="this.classList.remove('opacity-0'); this.previousElementSibling.remove();">
                                    </div>


                                <?php else: ?>
                                    <div class="no-image-placeholder" style="height: 100%; display:flex; flex-direction:column; justify-content:center; align-items:center; color:#9ca3af;">
                                        <svg width="48" height="48" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                        </svg>
                                        <span><?php echo $lang === 'en' ? 'No Image' : 'কোনো ছবি নেই'; ?></span>
                                    </div>
                                <?php endif; ?>
                            </div>
                            <div class="game-content" style="padding: 12px;">
                                <h1 class="game-rank" style="font-weight: bold; font-size: 18px; color:#f9fafb; margin-bottom: 6px;">
                                    <?= $gameName ?>
                                </h1>
                                <p class="game-description" style="font-size: 14px; color: #e5e7eb;">
                                    <?= $trimmed ?>
                                </p>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <div class="empty-state" style="text-align:center; padding:80px 20px; color:#6b7280; grid-column: 1 / -1;">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" style="width:64px; height:64px; margin-bottom:16px; color:#4b5563;">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414a1 1 0 00-.707-.293H4" />
                        </svg>
                        <h3 style="font-size: 20px; font-weight: 600; margin-bottom: 8px;">
                            <?php echo $lang === 'en' ? 'No Posts Found' : 'কোনো পোস্ট পাওয়া যায়নি'; ?>
                        </h3>
                    </div>
                <?php endif; ?>
            </div>

            <!-- Right Arrow Button -->
            <button id="next-btns" aria-label="Scroll Right" class="arrow-btn right-0">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none"
                    viewBox="0 0 24 24" stroke="currentColor" stroke-width="3">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                </svg>
            </button>
        </div>
    </div>

    <script>
        $(function() {
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
            $grid.on("scroll", function() {
                const maxScrollLeft = $grid[0].scrollWidth;
                const scrollLeft = $grid.scrollLeft();

                if (scrollLeft <= 0) {
                    $grid.scrollLeft(scrollLeft + (maxScrollLeft / 3));
                } else if (scrollLeft >= (maxScrollLeft * 2) / 3) {
                    $grid.scrollLeft(scrollLeft - (maxScrollLeft / 3));
                }
            });

            // Arrow buttons scroll with looping
            $("#prev-btns").on("click", function() {
                $grid.animate({
                    scrollLeft: $grid.scrollLeft() - scrollAmount
                }, 300);
            });

            $("#next-btns").on("click", function() {
                $grid.animate({
                    scrollLeft: $grid.scrollLeft() + scrollAmount
                }, 300);
            });
        });
    </script>