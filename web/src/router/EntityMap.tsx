import routeMapParser, {
  RouteMap,
} from '@irontec/ivoz-ui/router/routeMapParser';

import entities from '../entities/index';

const getEntityMap = (): RouteMap => {
  const map: RouteMap = [
    {
      entity: entities.Administrator,
    },
    {
      label: 'More',
      children: [
        {
          entity: entities.Service,
        }
      ],
    },
  ];

  return routeMapParser(map);
};

export default getEntityMap;
