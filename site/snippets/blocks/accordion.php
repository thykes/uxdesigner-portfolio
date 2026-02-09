<?php
/** @var \Kirby\Cms\Block $block */
$items = $block->items()->toStructure();
if ($items->isEmpty())
    return;

// Get the first item's image as default
$firstImage = $items->first()->image()->toFile();
$uniqueId = 'accordion-' . uniqid();
?>

<section class="mb-32">
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-start">
        <!-- Left: Accordion Items -->
        <div class="space-y-4">
            <?php foreach ($items as $index => $item): ?>
                <?php
                $itemId = $uniqueId . '-' . $index;
                $isFirst = $index === 0;
                ?>
                <div class="accordion-item border-b border-white/10 pb-4" data-accordion-id="<?= $itemId ?>">
                    <!-- Header: Always visible -->
                    <button
                        class="accordion-header w-full flex items-center justify-between text-left group cursor-pointer py-4 <?= $isFirst ? 'active' : '' ?>"
                        data-image="<?= $item->image()->toFile()?->url() ?? '' ?>"
                        onclick="toggleAccordion('<?= $itemId ?>', '<?= $uniqueId ?>')">
                        <div class="flex-1">
                            <h3 class="text-2xl font-bold mb-2 group-hover:text-[var(--accent)] transition-colors">
                                <?= $item->title()->html() ?>
                            </h3>
                            <p class="text-sm text-[var(--text-muted)] leading-relaxed">
                                <?= $item->preview()->html() ?>
                            </p>
                        </div>
                        <span
                            class="material-symbols-outlined text-3xl ml-4 transition-transform duration-300 accordion-icon <?= $isFirst ? 'rotate-180' : '' ?>">
                            expand_more
                        </span>
                    </button>

                    <!-- Expanded Content -->
                    <div
                        class="accordion-content overflow-hidden transition-all duration-500 <?= $isFirst ? 'max-h-[1000px] opacity-100' : 'max-h-0 opacity-0' ?>">
                        <div class="pt-4 pb-6 text-[var(--text-muted)] leading-relaxed">
                            <?= $item->content()->kirbytext() ?>
                        </div>
                    </div>
                </div>
            <?php endforeach ?>
        </div>

        <!-- Right: Image Display -->
        <div class="sticky top-24">
            <div class="aspect-[4/5] bg-[var(--charcoal)] rounded-lg overflow-hidden relative">
                <?php foreach ($items as $index => $item): ?>
                    <?php if ($image = $item->image()->toFile()): ?>
                        <img id="<?= $uniqueId ?>-img-<?= $index ?>" src="<?= $image->url() ?>"
                            alt="<?= $item->title()->html() ?>"
                            class="accordion-image absolute inset-0 w-full h-full object-cover transition-opacity duration-500 <?= $index === 0 ? 'opacity-100 z-10' : 'opacity-0 z-0' ?>" />
                    <?php endif ?>
                <?php endforeach ?>
            </div>
        </div>
    </div>
</section>

<script>
    function toggleAccordion(itemId, groupId) {
        const clickedItem = document.querySelector(`[data-accordion-id="${itemId}"]`);
        const allItems = document.querySelectorAll(`[data-accordion-id^="${groupId}"]`);
        const clickedHeader = clickedItem.querySelector('.accordion-header');
        const clickedContent = clickedItem.querySelector('.accordion-content');
        const clickedIcon = clickedItem.querySelector('.accordion-icon');

        // Get the index from the itemId
        const clickedIndex = itemId.split('-').pop();

        // Close all other items in this group
        allItems.forEach(item => {
            if (item !== clickedItem) {
                const header = item.querySelector('.accordion-header');
                const content = item.querySelector('.accordion-content');
                const icon = item.querySelector('.accordion-icon');

                header.classList.remove('active');
                content.classList.remove('max-h-[1000px]', 'opacity-100');
                content.classList.add('max-h-0', 'opacity-0');
                icon.classList.remove('rotate-180');
            }
        });

        // Toggle the clicked item
        const isActive = clickedHeader.classList.contains('active');

        if (isActive) {
            clickedHeader.classList.remove('active');
            clickedContent.classList.remove('max-h-[1000px]', 'opacity-100');
            clickedContent.classList.add('max-h-0', 'opacity-0');
            clickedIcon.classList.remove('rotate-180');
        } else {
            clickedHeader.classList.add('active');
            clickedContent.classList.add('max-h-[1000px]', 'opacity-100');
            clickedContent.classList.remove('max-h-0', 'opacity-0');
            clickedIcon.classList.add('rotate-180');
        }

        // Switch images
        const allImages = document.querySelectorAll(`[id^="${groupId}-img-"]`);
        allImages.forEach((img, index) => {
            if (index == clickedIndex) {
                img.classList.add('opacity-100', 'z-10');
                img.classList.remove('opacity-0', 'z-0');
            } else {
                img.classList.remove('opacity-100', 'z-10');
                img.classList.add('opacity-0', 'z-0');
            }
        });
    }
</script>