<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GitHub Pull Requests Clone</title>
    <link rel="icon" href="https://github.githubassets.com/favicons/favicon.svg" type="image/svg+xml">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'github-dark': '#0d1117',
                        'github-darker': '#161B22',
                        'github-border': '#30363D',
                        'github-text': '#C9D1D9',
                        'github-secondary': '#8B949E',
                        'github-green': '#238636',
                        'github-link': '#58a6ff',
                    }
                }
            }
        }
    </script>
</head>
<body class="bg-github-dark text-github-text">
    <div class="min-h-screen">
        <!-- Header Navigation -->
        <nav class="bg-github-darker border-b border-github-border px-4 py-4">
            <div class="flex items-center gap-4">
                <button class="text-github-text hover:text-white">
                    <i class="fas fa-bars text-xl"></i>
                </button>
                <a href="#" class="text-github-text hover:text-white">
                    <i class="fab fa-github text-2xl"></i>
                </a>
                <span class="font-semibold">josh-zanecoder / josh-zanecoder</span>
            </div>
        </nav>


        <!-- Tab Navigation -->
        <div class="border-b border-github-border px-4 py-3">
            <nav class="flex justify-between">
                <div class="flex space-x-6">
                    <a href="#" class="flex items-center gap-2 text-github-secondary hover:text-github-text">
                        <i class="fas fa-code"></i>
                        <span>Code</span>
                    </a>
                    <a href="#" class="flex items-center gap-2 text-github-secondary hover:text-github-text">
                        <i class="fas fa-exclamation-circle"></i>
                        <span>Issues</span>
                    </a>
                    <a href="#" class="flex items-center gap-2 text-github-text font-semibold">
                        <i class="fas fa-code-pull-request"></i>
                        <span>Pull requests</span>
                        <span class="pr-count bg-github-border px-2 py-0.5 rounded-full text-xs">2</span>
                    </a>
                    <a href="#" class="hidden sm:flex items-center gap-2 text-github-secondary hover:text-github-text">
                        <i class="fas fa-play"></i>
                        <span>Actions</span>
                    </a>
                    <a href="#" class="hidden sm:flex items-center gap-2 text-github-secondary hover:text-github-text">
                        <i class="fas fa-project-diagram"></i>
                        <span>Projects</span>
                    </a>
                    <a href="#" class="hidden sm:flex items-center gap-2 text-github-secondary hover:text-github-text">
                        <i class="fas fa-shield-alt"></i>
                        <span>Security</span>
                    </a>
                </div>
                
                <!-- More menu button -->
                <div class="relative">
                    <button 
                        id="moreMenuButton"
                        class="flex items-center justify-center ml-4 text-github-secondary hover:text-github-text sm:hidden"
                        onclick="toggleMoreMenu()"
                    >
                        <i class="fas fa-ellipsis"></i>
                    </button>
                    <!-- Dropdown menu -->
                    <div id="moreMenu" class="hidden absolute right-0 mt-2 py-2 w-48 bg-github-darker border border-github-border rounded-md shadow-lg">
                        <a href="#" class="px-4 py-2 flex items-center gap-2 text-github-secondary hover:bg-github-border">
                            <i class="fas fa-play"></i>
                            <span>Actions</span>
                        </a>
                        <a href="#" class="px-4 py-2 flex items-center gap-2 text-github-secondary hover:bg-github-border">
                            <i class="fas fa-project-diagram"></i>
                            <span>Projects</span>
                        </a>
                        <a href="#" class="px-4 py-2 flex items-center gap-2 text-github-secondary hover:bg-github-border">
                            <i class="fas fa-shield-alt"></i>
                            <span>Security</span>
                        </a>
                    </div>
                </div>
            </nav>
        </div>

        <!-- Main Content -->
        <div class="max-w-[1280px] mx-auto px-4 mt-6">
            <!-- Wrapper for large screen single line -->
            <div class="flex flex-col lg:flex-row lg:items-center lg:gap-4">
                <!-- Labels, Milestones buttons and New button (always first in DOM) -->
                <div class="flex justify-between mb-4 lg:mb-0 lg:order-2">
                    <div class="flex gap-2">
                        <button class="px-3 py-1.5 bg-github-darker border border-github-border rounded-md hover:border-github-text flex items-center gap-2">
                            <i class="fas fa-tag"></i>
                            <span>Labels</span>
                        </button>
                        <button class="px-3 py-1.5 bg-github-darker border border-github-border rounded-md hover:border-github-text flex items-center gap-2">
                            <i class="fas fa-flag"></i>
                            <span>Milestones</span>
                        </button>
                    </div>
                    <button class="px-3 py-1.5 bg-github-green text-white rounded-md hover:bg-opacity-90 font-semibold ml-6">
                        <span class="hidden sm:inline">New pull request</span>
                        <span class="sm:hidden">New</span>
                    </button>
                </div>

                <!-- Filter and Search -->
                <div class="flex gap-2 lg:flex-1 lg:order-1">
                    <div class="relative">
                        <button id="filterButton" 
                                class="px-3 py-1.5 bg-github-darker border border-github-border rounded-md hover:border-github-text flex items-center justify-between gap-2">
                            <span>Filters</span>
                            <i class="fas fa-caret-down text-xs"></i>
                        </button>
                        <!-- Filter Dropdown -->
                        <div id="filterDropdown" 
                             class="absolute left-0 mt-2 w-[300px] bg-github-darker border border-github-border rounded-md shadow-lg hidden z-50">
                            <!-- Header -->
                            <div class="flex items-center justify-between p-2 border-b border-github-border">
                                <span class="text-sm font-semibold text-github-text">Filter Issues</span>
                                <button id="closeFilter" class="text-github-secondary hover:text-github-text">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>

                            <!-- Filter Options -->
                            <div class="py-1">
                                <a href="#" id="your-prs" class="filter-item block px-4 py-2 text-github-text hover:bg-github-border">
                                    Your pull requests
                                </a>
                                <a href="#" id="assigned-to-you" class="filter-item block px-4 py-2 text-github-text hover:bg-github-border">
                                    Everything assigned to you
                                </a>
                                <a href="#" id="mentioning-you" class="filter-item block px-4 py-2 text-github-text hover:bg-github-border">
                                    Everything mentioning you
                                </a>
                                <div class="border-t border-github-border my-1"></div>
                                <a href="https://docs.github.com/search-github/searching-on-github/searching-issues-and-pull-requests" 
                                   target="_blank"
                                   class="filter-item block px-4 py-2 text-github-text hover:bg-github-border flex items-center gap-2">
                                    <i class="fas fa-arrow-up-right-from-square text-xs"></i>
                                    <span>View advanced search syntax</span>
                                </a>
                            </div>
                        </div>
                    </div>
                    <input 
                        type="text" 
                        class="flex-1 px-3 py-1.5 bg-github-darker border border-github-border rounded-md text-github-text placeholder-github-secondary focus:border-github-link focus:outline-none"
                        placeholder="is:pr is:open"
                    >
                </div>
            </div>

            <!-- Pull Requests List -->
            <div class="border border-github-border rounded-md mt-6">
                <!-- List Header -->
                <div class="p-3 bg-github-darker border-b border-github-border">
                    <div class="flex items-center gap-4">
                        <div class="flex items-center gap-2">
                            <i class="fas fa-code-pull-request"></i>
                            <span>2 Open</span>
                        </div>
                        <div class="flex items-center gap-2 text-github-secondary">
                            <i class="fas fa-check"></i>
                            <span>2 Closed</span>
                        </div>
                    </div>

                    <!-- Filter Options -->
                    <div class="flex mt-3 gap-6 text-github-secondary">
                        <button class="hover:text-github-text">Author</button>
                        <button class="hover:text-github-text">Label</button>
                        <button class="hover:text-github-text">Assignee</button>
                        <button class="hover:text-github-text">Sort</button>
                    </div>
                </div>

                <!-- Pull Request Items -->
                <div id="pullRequestsList" class="divide-y divide-github-border">
                    <div class="flex items-start px-3 py-2 hover:bg-github-darker">
                        <div class="flex-shrink-0 pt-1">
                            <i class="fas fa-code-pull-request text-github-green"></i>
                        </div>
                        <div class="ml-2 min-w-0 flex-1">
                            <div class="flex items-baseline">
                                <a href="#" class="font-semibold text-github-text hover:text-github-link">
                                    github clone task
                                </a>
                            </div>
                            <div class="text-xs text-github-secondary mt-0.5">
                                #3 opened 6 hours ago by josh-zanecoder
                            </div>
                        </div>
                    </div>

                    <div class="flex items-start px-3 py-2 hover:bg-github-darker">
                        <div class="flex-shrink-0 pt-1">
                            <i class="fas fa-code-pull-request text-github-green"></i>
                        </div>
                        <div class="ml-2 min-w-0 flex-1">
                            <div class="flex items-baseline">
                                <a href="#" class="font-semibold text-github-text hover:text-github-link">
                                    Update README.md
                                </a>
                            </div>
                            <div class="text-xs text-github-secondary mt-0.5">
                                #2 opened 6 hours ago by josh-zanecoder
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- ProTip -->
            <div class="p-4 text-sm text-github-secondary border-t border-github-border">
                <span class="font-semibold">ProTip!</span> Notify someone on an issue with a mention, like: @josh-zanecoder.
            </div>
        </div>
    </div>

<script>
    class GitHubAPI {
    constructor() {
        this.baseUrl = 'https://api.github.com';
        this.owner = 'josh-zanecoder';
        this.repo = 'josh-zanecoder';
        this.currentState = 'open';
    }

    async fetchPullRequests(state, filter = '') {
        try {
            const response = await fetch(
                `${this.baseUrl}/repos/${this.owner}/${this.repo}/pulls?state=${state}&per_page=100`,
                {
                    headers: {
                        'Accept': 'application/vnd.github.v3+json'
                    }
                }
            );

            if (!response.ok) {
                throw new Error(`HTTP error! status: ${response.status}`);
            }

            let data = await response.json();

            // Apply filters
            switch(filter) {
                case 'your-prs':
                    data = data.filter(pr => pr.user.login === this.owner);
                    break;
                case 'assigned-to-you':
                    data = data.filter(pr => 
                        pr.assignees && 
                        pr.assignees.some(a => a.login === this.owner)
                    );
                    break;
                case 'mentioning-you':
                    // Show all PRs when "mentioning you" is selected since we're in our own repo
                    break;
            }

            return data;
        } catch (error) {
            console.error('Error fetching pull requests:', error);
            throw error;
        }
    }

    async getPRCounts() {
        try {
            const [openPRs, closedPRs] = await Promise.all([
                this.fetchPullRequests('open'),
                this.fetchPullRequests('closed')
            ]);

            return {
                open: openPRs.length,
                closed: closedPRs.length
            };
        } catch (error) {
            console.error('Error fetching PR counts:', error);
            return { open: 0, closed: 0 };
        }
    }
    }

    document.addEventListener('DOMContentLoaded', async () => {
    const github = new GitHubAPI();
    let currentFilter = '';
    const openCount = document.querySelector('.open-count');
    const closedCount = document.querySelector('.closed-count');
    const openButton = document.querySelector('[data-state="open"]');
    const closedButton = document.querySelector('[data-state="closed"]');

    // Add click handlers for filter options
    document.querySelectorAll('.filter-item').forEach(item => {
        item.addEventListener('click', async (e) => {
            e.preventDefault();
            if (item.id === 'advanced-search') return;
            
            currentFilter = item.id;
            filterDropdown.classList.add('hidden');
            await displayPullRequests(github.currentState, currentFilter);
        });
    });

    async function displayPullRequests(state, filter = '') {
        try {
            pullRequestsList.innerHTML = '<div class="p-4 text-github-secondary">Loading pull requests...</div>';
            
            const prs = await github.fetchPullRequests(state, filter);
            pullRequestsList.innerHTML = '';
            
            if (!prs || prs.length === 0) {
                pullRequestsList.innerHTML = `
                    <div class="p-4 text-github-secondary">
                        No ${state} pull requests ${filter ? 'matching the filter' : ''}
                    </div>
                `;
                return;
            }
            
            // Sort PRs by creation date (newest first)
            prs.sort((a, b) => new Date(b.created_at) - new Date(a.created_at));
            
            prs.forEach(pr => {
                // Format the date to match GitHub's format
                const date = new Date(pr.closed_at || pr.created_at);
                const formattedDate = formatDate(date);
                
                const prElement = document.createElement('div');
                prElement.className = 'p-4 hover:bg-github-darker flex gap-4 group';
                
                const statusIcon = state === 'open' ? 
                    '<i class="fas fa-code-branch"></i>' : 
                    '<i class="fas fa-check text-purple-500"></i>';
                
                prElement.innerHTML = `
                    <div class="text-github-green">
                        ${statusIcon}
                    </div>
                    <div class="flex-1">
                        <div class="flex items-start justify-between">
                            <div>
                                <a href="${pr.html_url}" 
                                   class="text-github-text hover:text-github-link font-semibold block"
                                   target="_blank">
                                    ${pr.title}
                                </a>
                                <div class="text-github-secondary text-sm mt-1">
                                    #${pr.number} ${state === 'closed' ? 'closed' : 'opened'} on ${formattedDate} by ${pr.user.login}
                                </div>
                            </div>
                            ${pr.labels && pr.labels.length > 0 ? `
                                <div class="flex gap-2 flex-wrap">
                                    ${pr.labels.map(label => `
                                        <span class="px-2 py-0.5 text-xs rounded-full" 
                                              style="background-color: #${label.color}">
                                            ${label.name}
                                        </span>
                                    `).join('')}
                                </div>
                            ` : ''}
                        </div>
                    </div>
                `;
                
                pullRequestsList.appendChild(prElement);
            });
        } catch (error) {
            console.error('Error displaying pull requests:', error);
            pullRequestsList.innerHTML = `
                <div class="p-4 text-github-secondary">
                    Error loading pull requests. Please try again later.
                </div>
            `;
        }
    }

    // Helper function to format dates like GitHub
    function formatDate(date) {
        const now = new Date();
        const diffTime = Math.abs(now - date);
        const diffDays = Math.floor(diffTime / (1000 * 60 * 60 * 24));
        const diffMonths = Math.floor(diffDays / 30);
        const diffYears = Math.floor(diffDays / 365);

        // Format the date in MM/DD/YYYY format
        const month = (date.getMonth() + 1).toString().padStart(2, '0');
        const day = date.getDate().toString().padStart(2, '0');
        const year = date.getFullYear();
        const formattedDate = `${month}/${day}/${year}`;

        if (diffYears > 0) {
            return formattedDate;
        } else if (diffMonths > 0) {
            return formattedDate;
        } else if (diffDays > 0) {
            return formattedDate;
        } else {
            const hours = date.getHours();
            const minutes = date.getMinutes().toString().padStart(2, '0');
            const ampm = hours >= 12 ? 'PM' : 'AM';
            const formattedHours = hours % 12 || 12;
            return `${formattedHours}:${minutes} ${ampm}`;
        }
    }

    // Function to update counts
    async function updatePRCounts() {
        try {
            const counts = await github.getPRCounts();
            openCount.textContent = counts.open;
            closedCount.textContent = counts.closed;
        } catch (error) {
            console.error('Error updating PR counts:', error);
            openCount.textContent = '-';
            closedCount.textContent = '-';
        }
    }

    // Function to update active state
    function updateActiveState(state) {
        if (state === 'open') {
            openButton.classList.add('text-github-text');
            openButton.classList.remove('text-github-secondary');
            closedButton.classList.add('text-github-secondary');
            closedButton.classList.remove('text-github-text');
        } else {
            closedButton.classList.add('text-github-text');
            closedButton.classList.remove('text-github-secondary');
            openButton.classList.add('text-github-secondary');
            openButton.classList.remove('text-github-text');
        }
    }

    // Click handlers for open/closed buttons
    openButton.addEventListener('click', async () => {
        if (github.currentState !== 'open') {
            github.currentState = 'open';
            updateActiveState('open');
            await displayPullRequests('open');
        }
    });

    closedButton.addEventListener('click', async () => {
        if (github.currentState !== 'closed') {
            github.currentState = 'closed';
            updateActiveState('closed');
            await displayPullRequests('closed');
        }
    });

    // Initial load
    await updatePRCounts();
    updateActiveState('open');
    await displayPullRequests('open');

    // Update counts when filters change
    filterItems.forEach(item => {
        item.addEventListener('click', async () => {
            await updatePRCounts();
        });
    });
});

document.addEventListener('DOMContentLoaded', () => {
    const filterButton = document.getElementById('filterButton');
    const filterDropdown = document.getElementById('filterDropdown');
    const closeFilter = document.getElementById('closeFilter');
    const filterItems = document.querySelectorAll('.filter-item');

    // Toggle filter dropdown
    filterButton.addEventListener('click', (e) => {
        e.stopPropagation();
        filterDropdown.classList.toggle('hidden');
    });

    // Close button
    closeFilter.addEventListener('click', () => {
        filterDropdown.classList.add('hidden');
    });

    // Handle filter selections
    filterItems.forEach(item => {
        item.addEventListener('click', async (e) => {
            if (item.id === 'advanced-search') return; // Skip for external link
            
            e.preventDefault();
            const filterId = item.id;
            
            // Update search input with appropriate filter
            const searchInput = document.querySelector('input[type="text"]');
            switch(filterId) {
                case 'your-prs':
                    searchInput.value = 'is:pr author:@me';
                    break;
                case 'assigned-to-you':
                    searchInput.value = 'is:pr assignee:@me';
                    break;
                case 'mentioning-you':
                    searchInput.value = 'is:pr mentions:@me';
                    break;
            }

            // Close dropdown and trigger search
            filterDropdown.classList.add('hidden');
            searchInput.dispatchEvent(new Event('input'));
        });
    });

    // Close dropdown when clicking outside
    document.addEventListener('click', (e) => {
        if (!filterDropdown.contains(e.target) && !filterButton.contains(e.target)) {
            filterDropdown.classList.add('hidden');
        }
    });
});

function toggleMoreMenu() {
    const menu = document.getElementById('moreMenu');
    menu.classList.toggle('hidden');

    // Close menu when clicking outside
    document.addEventListener('click', function closeMenu(e) {
        const button = document.getElementById('moreMenuButton');
        const menu = document.getElementById('moreMenu');
        if (!button.contains(e.target) && !menu.contains(e.target)) {
            menu.classList.add('hidden');
            document.removeEventListener('click', closeMenu);
        }
    });
}
</script>
</body>
</html>
