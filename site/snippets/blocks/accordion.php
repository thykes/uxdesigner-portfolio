<?php
/** @var \Kirby\Cms\Block $block */
$items = $block->items()->toStructure();
if ($items->isEmpty())
    return;

$uniqueId = 'accordion-' . uniqid();
?>

<section class="mb-32">
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-16 items-start">
        <!-- Left: Accordion Items -->
        <div class="lg:col-span-4 space-y-2">
            <?php foreach ($items as $index => $item): ?>
                <?php
                $itemId = $uniqueId . '-' . $index;
                $isFirst = $index === 0;
                ?>
                <div class="accordion-item border-b border-white/10" data-accordion-id="<?= $itemId ?>">
                    <!-- Header: Always visible -->
                    <button
                        class="accordion-header w-full flex items-center justify-between text-left group cursor-pointer py-6 <?= $isFirst ? 'active' : '' ?>"
                        data-image="<?= $item->image()->toFile()?->url() ?? '' ?>"
                        onclick="toggleAccordion('<?= $itemId ?>', '<?= $uniqueId ?>')">
                        <h3
                            class="text-3xl font-sans font-medium group-hover:text-[var(--accent)] transition-colors flex-1">
                            <?= $item->title()->html() ?>
                        </h3>
                        <span
                            class="material-symbols-outlined text-3xl ml-6 transition-transform duration-300 accordion-icon flex-shrink-0 <?= $isFirst ? 'rotate-180' : '' ?>">
                            expand_more
                        </span>
                    </button>

                    <!-- Expanded Content -->
                    <div id="<?= $itemId ?>-content"
                        class="accordion-content overflow-hidden transition-all duration-300 ease-in-out"
                        style="max-height: <?= $isFirst ? '1000px' : '0px' ?>; opacity: <?= $isFirst ? '1' : '0' ?>; margin-bottom: <?= $isFirst ? '1.5rem' : '0' ?>;">
                        <div class="text-[var(--text-muted)] leading-relaxed text-lg">
                            <?php
                            // Try to get 'text' field first (new format), fallback to 'content' (old format)
                            // We use $item->content()->get() to avoid conflict with StructureObject::content() method
                            $textContent = $item->content()->get('text');
                            if ($textContent->isEmpty()) {
                                $textContent = $item->content()->get('content');
                            }
                            ?>
                            <?= $textContent->kirbytext() ?>
                        </div>
                    </div>
                </div>
            <?php endforeach ?>
        </div>

        <!-- Right: Image Display -->
        <div class="sticky top-24 hidden lg:block lg:col-span-8">
            <div class="relative w-full rounded-lg overflow-hidden bg-[var(--charcoal)]"
                style="height: 60vh; max-height: 600px;">
                <?php foreach ($items as $index => $item): ?>
                    <?php if ($image = $item->image()->toFile()): ?>
                        <img id="<?= $uniqueId ?>-img-<?= $index ?>" src="<?= $image->url() ?>"
                            alt="<?= $item->title()->html() ?>"
                            class="accordion-image absolute inset-0 w-full h-full object-contain p-8 transition-opacity duration-500 <?= $index === 0 ? 'opacity-100 z-10' : 'opacity-0 z-0' ?>" />
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
        const clickedContent = document.getElementById(`${itemId}-content`);
        const clickedIcon = clickedItem.querySelector('.accordion-icon');

        // Get the index from the itemId
        const clickedIndex = itemId.split('-').pop();

        // Close all other items in this group
        allItems.forEach(item => {
            if (item !== clickedItem) {
                const header = item.querySelector('.accordion-header');
                const contentId = item.dataset.accordionId + '-content';
                const content = document.getElementById(contentId);
                const icon = item.querySelector('.accordion-icon');

                if (header) header.classList.remove('active');
                if (content) {
                    content.style.maxHeight = '0px';
                    content.style.opacity = '0';
                    content.style.marginBottom = '0';
                }
                if (icon) icon.classList.remove('rotate-180');
            }
        });

        // Toggle the clicked item
        const isActive = clickedHeader.classList.contains('active');

        if (isActive) {
            clickedHeader.classList.remove('active');
            clickedContent.style.maxHeight = '0px';
            clickedContent.style.opacity = '0';
            clickedContent.style.marginBottom = '0';
            clickedIcon.classList.remove('rotate-180');
        } else {
            clickedHeader.classList.add('active');
            // Check scroll height for smooth animation
            clickedContent.style.maxHeight = clickedContent.scrollHeight + 'px';
            clickedContent.style.opacity = '1';
            clickedContent.style.marginBottom = '1.5rem';
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