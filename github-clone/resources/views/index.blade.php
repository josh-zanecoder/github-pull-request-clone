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
                        'github-darker': '#161b22',
                        'github-border': '#30363d',
                        'github-text': '#c9d1d9',
                        'github-secondary': '#8b949e',
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
            <nav class="flex space-x-6">
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
                    <span class="pr-count bg-github-border px-2 py-0.5 rounded-full text-xs">...</span>
                </a>
                <a href="#" class="flex items-center gap-2 text-github-secondary hover:text-github-text">
                    <i class="fas fa-play"></i>
                    <span>Actions</span>
                </a>
                <a href="#" class="flex items-center gap-2 text-github-secondary hover:text-github-text">
                    <i class="fas fa-project-diagram"></i>
                    <span>Projects</span>
                </a>
                <a href="#" class="flex items-center gap-2 text-github-secondary hover:text-github-text">
                    <i class="fas fa-shield-alt"></i>
                    <span>Security</span>
                </a>
            </nav>
        </div>

        <!-- Main Content -->
        <div class="max-w-[1280px] mx-auto px-4">
            <!-- Search Bar and Buttons -->
            <div class="flex justify-between py-4 gap-4 flex-col sm:flex-row">
                <div class="flex gap-2 flex-1">
                    <button class="px-3 py-1.5 bg-github-darker border border-github-border rounded-md hover:border-github-text">
                        Filters
                    </button>
                    <input 
                        type="text" 
                        class="flex-1 sm:max-w-md px-3 py-1.5 bg-github-darker border border-github-border rounded-md text-github-text placeholder-github-secondary focus:border-github-link focus:outline-none"
                        placeholder="is:pr is:open"
                    >
                </div>
                <div class="flex gap-2 flex-wrap">
                    <button class="px-3 py-1.5 bg-github-darker border border-github-border rounded-md hover:border-github-text">
                        Labels <span class="labels-count bg-github-border px-2 py-0.5 rounded-full text-xs ml-1">...</span>
                    </button>
                    <button class="px-3 py-1.5 bg-github-darker border border-github-border rounded-md hover:border-github-text">
                        Milestones <span class="milestones-count bg-github-border px-2 py-0.5 rounded-full text-xs ml-1">0</span>
                    </button>
                    <button class="px-3 py-1.5 bg-github-green text-white rounded-md hover:bg-opacity-90">
                        New pull request
                    </button>
                </div>
            </div>

            <!-- Pull Requests List -->
            <div class="border border-github-border rounded-md">
                <div class="p-4 bg-github-darker border-b border-github-border flex justify-between flex-col sm:flex-row gap-4">
                    <div class="flex gap-4">
                        <button class="status-btn flex items-center gap-2 text-github-text" data-state="open">
                            <i class="fas fa-code-branch"></i>
                            <span class="open-count">...</span> Open
                        </button>
                        <button class="status-btn flex items-center gap-2 text-github-secondary hover:text-github-text" data-state="closed">
                            <i class="fas fa-check"></i>
                            <span class="closed-count">...</span> Closed
                        </button>
                    </div>
                    <div class="flex gap-2 flex-wrap">
                        <button class="px-2 py-1 text-github-secondary hover:text-github-text">Author</button>
                        <button class="px-2 py-1 text-github-secondary hover:text-github-text">Label</button>
                        <button class="px-2 py-1 text-github-secondary hover:text-github-text">Projects</button>
                        <button class="px-2 py-1 text-github-secondary hover:text-github-text">Milestones</button>
                        <button class="px-2 py-1 text-github-secondary hover:text-github-text">Assignee</button>
                        <button class="px-2 py-1 text-github-secondary hover:text-github-text">Sort</button>
                    </div>
                </div>
                <div id="pullRequestsList" class="divide-y divide-github-border">
                    <!-- Loading state -->
                    <div class="p-4 text-github-secondary">
                        Loading pull requests...
                    </div>
                </div>
            </div>
        </div>
    </div>

<script>
class GitHubAPI {
    constructor() {
        this.baseUrl = 'https://api.github.com';
        this.owner = 'josh-zanecoder';
        this.repo = 'josh-zanecoder';
        this.currentState = 'open'; // Track current state
    }

    async fetchPullRequests(state) {
        try {
            console.log(`Fetching ${state} PRs...`); // Debug log
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

            const data = await response.json();
            console.log(`${state} PRs:`, data); // Debug log
            return data;
        } catch (error) {
            console.error('Error fetching pull requests:', error);
            throw error;
        }
    }

    async getPRStats() {
        try {
            // Fetch both open and closed PRs
            const openPRs = await this.fetchPullRequests('open');
            const closedPRs = await this.fetchPullRequests('closed');

            return {
                open: openPRs.length,
                closed: closedPRs.length,
                total: openPRs.length + closedPRs.length
            };
        } catch (error) {
            console.error('Error fetching PR stats:', error);
            throw error;
        }
    }
}

document.addEventListener('DOMContentLoaded', async () => {
    const github = new GitHubAPI();
    const pullRequestsList = document.getElementById('pullRequestsList');
    const openButton = document.querySelector('.status-btn[data-state="open"]');
    const closedButton = document.querySelector('.status-btn[data-state="closed"]');

    // Update PR counts
    try {
        const stats = await github.getPRStats();
        document.querySelector('.open-count').textContent = stats.open;
        document.querySelector('.closed-count').textContent = stats.closed;
        document.querySelector('.pr-count').textContent = stats.total;
    } catch (error) {
        console.error('Failed to load PR stats:', error);
        document.querySelector('.open-count').textContent = '-';
        document.querySelector('.closed-count').textContent = '-';
        document.querySelector('.pr-count').textContent = '-';
    }

    async function displayPullRequests(state) {
        try {
            github.currentState = state; // Update current state
            pullRequestsList.innerHTML = '<div class="p-4 text-github-secondary">Loading pull requests...</div>';
            
            const prs = await github.fetchPullRequests(state);
            pullRequestsList.innerHTML = '';
            
            if (!prs || prs.length === 0) {
                pullRequestsList.innerHTML = `
                    <div class="p-4 text-github-secondary">
                        No ${state} pull requests
                    </div>
                `;
                return;
            }
            
            // Sort PRs by creation date (newest first)
            prs.sort((a, b) => new Date(b.created_at) - new Date(a.created_at));
            
            prs.forEach(pr => {
                const createdDate = new Date(pr.created_at).toLocaleDateString();
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
                                    #${pr.number} ${state === 'closed' ? 'closed' : 'opened'} on ${createdDate} by ${pr.user.login}
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

    // Add click handlers for filter buttons with proper state management
    openButton.addEventListener('click', () => {
        if (github.currentState !== 'open') {
            openButton.classList.add('text-github-text');
            openButton.classList.remove('text-github-secondary');
            closedButton.classList.add('text-github-secondary');
            closedButton.classList.remove('text-github-text');
            displayPullRequests('open');
        }
    });

    closedButton.addEventListener('click', () => {
        if (github.currentState !== 'closed') {
            closedButton.classList.add('text-github-text');
            closedButton.classList.remove('text-github-secondary');
            openButton.classList.add('text-github-secondary');
            openButton.classList.remove('text-github-text');
            displayPullRequests('closed');
        }
    });

    // Initial load of open PRs
    displayPullRequests('open');
});
</script>
</body>
</html>
