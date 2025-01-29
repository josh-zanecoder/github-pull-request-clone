import '@testing-library/jest-dom';
import { fireEvent, waitFor } from '@testing-library/dom';

describe('Pull Requests UI', () => {
    beforeEach(() => {
        document.body.innerHTML = `
            <div id="pullRequestsList"></div>
            <button class="status-btn" data-state="open">Open</button>
            <button class="status-btn" data-state="closed">Closed</button>
        `;
    });

    test('switches between open and closed PRs', async () => {
        const openButton = document.querySelector('[data-state="open"]');
        const closedButton = document.querySelector('[data-state="closed"]');

        fireEvent.click(closedButton);

        await waitFor(() => {
            expect(closedButton).toHaveClass('text-github-text');
            expect(openButton).toHaveClass('text-github-secondary');
        });
    });
}); 