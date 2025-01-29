import { GitHubAPI } from '../../resources/js/github-api';

describe('GitHubAPI', () => {
    let api;

    beforeEach(() => {
        api = new GitHubAPI();
        fetch.resetMocks();
    });

    test('fetchPullRequests fetches data correctly', async () => {
        const mockData = [
            {
                id: 1,
                title: 'Test PR',
                state: 'open'
            }
        ];

        fetch.mockResponseOnce(JSON.stringify(mockData));

        const result = await api.fetchPullRequests('open');
        expect(result).toEqual(mockData);
        expect(fetch).toHaveBeenCalledWith(
            expect.stringContaining('/pulls?state=open'),
            expect.any(Object)
        );
    });

    test('getPRStats returns correct counts', async () => {
        fetch
            .mockResponseOnce(JSON.stringify([{}, {}])) // 2 open PRs
            .mockResponseOnce(JSON.stringify([{}, {}, {}])); // 3 closed PRs

        const stats = await api.getPRStats();
        expect(stats).toEqual({
            open: 2,
            closed: 3,
            total: 5
        });
    });
}); 