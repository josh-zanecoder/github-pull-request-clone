function displayPullRequests(pullRequests) {
    pullRequestsList.innerHTML = '';
    
    pullRequests.forEach(pr => {
        const createdDate = new Date(pr.created_at).toLocaleDateString();
        const prElement = document.createElement('div');
        prElement.className = 'p-4 hover:bg-github-darker flex gap-4';
        prElement.innerHTML = `
            <div class="text-github-green">
                <i class="fas fa-code-branch"></i>
            </div>
            <div>
                <a href="${pr.html_url}" class="text-github-text hover:text-github-link font-semibold" target="_blank">
                    ${pr.title}
                </a>
                <div class="text-github-secondary text-sm">
                    #${pr.number} opened on ${createdDate} by ${pr.user.login}
                </div>
            </div>
        `;
        pullRequestsList.appendChild(prElement);
    });
}